<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Wesly {

    private $token = "EAAKtAJ0lxooBAEXjEXMsAwpPTiZAuBT1gIY97kEEmUeZBHRedJl8CHT8zLaeZA4s0vAeCZAkihPNYsx2R0FSr4swj1Xaxbh3zUDENyRF8a9Si8FeajzorUOvTvHGfN72Q0fUfU0QhF77JZBoYeKqG6BzvoeA67MbdUsgTIrb2OwZDZD";
    public function __construct()
    {
      // Assign the CodeIgniter super-object
      $this->CI =& get_instance();

      $this->CI->load->library('jsonMessages');

      $this->CI->load->library('sendAPI');
      $this->CI->load->model("user_postavke");
      $this->CI->load->model("obavjesti");
  
    }

    public function reciveTextMessage($sender, $poruka)
    {
      $izrezano = explode(" ", $poruka);
      switch ($izrezano[0]) {
        case 'rezerviraj':
			// provjeri za datum
			$fali = array("datum" => true, "vrijeme" => true, "username" => true);
			if(!isset($izrezano[1]) || !isset($izrezano[2]) || !isset($izrezano[3]))
            {
              self::odgovori($sender,"Treba unesti 'rezerviraj {username} {GGGG-MM-DD} {HH:MM}'");
              break;
            }
			
			preg_match('/(2\d\d\d-[0-9]{1,2}-[0-9]{1,2})/', $poruka, $datumi, PREG_OFFSET_CAPTURE);
			if(!empty($datumi) ){
				$parsano_datum = strtotime( $datumi[0][0] );
				if(!$parsano_datum)
				{
					self::odgovori($sender, "Datum nije ispravnog oblika, Datum treba biti oblika Godina-mjesec-datum, brojevima. Primjer: 2017-4-2" );
					return;
				}
				$datum = date("Y-m-d", $parsano_datum);
				$fali["datum"] = false;
				
			}
			preg_match('/\d{1,2}:\d{1,2}/', $poruka, $vremena, PREG_OFFSET_CAPTURE);
			if(!empty($vremena) ){
				$parsano_vrijeme = strtotime($vremena[0][0]);
				if(!$parsano_vrijeme)
				{
					self::odgovori($sender, "Vrijeme nije ispravnog oblika, Vrijeme treba biti oblika Sati:MInute. Primjer: 12:30" );
					return;
				}
				$vrijeme = date("H:i:s", $parsano_vrijeme);
				$fali["vrijeme"] = false;
			}
			
			
			
			
			
			
            $username = $izrezano[1];
            
            self::rezerviraj($username, $datum, $vrijeme, $sender);
          break;
        case 'verificiraj':
            if( !isset($izrezano[1]) )
            {
              self::odgovori($sender, "Treba unesi token za rezervaciju");
              break;
            }
            $token = $izrezano[1];
            self::verificiraj($token, $sender);
        break;
        case 'prihvati':
          if( !isset($izrezano[1]) )
            {
              self::odgovori($sender, "Treba identifikator termina");
              break;
            }
            $hash = $izrezano[1];
            self::prihvati($hash,$sender);
        break;
        case 'odbij':
            if( !isset($izrezano[1]) )
            {
              self::odgovori($sender, "Treba unseti identifikator termina" );
              break;
            }
            $hash = $izrezano[1];
            self::odbij($hash,$sender);
        break;
        case 'info':
            if( !isset($izrezano[1]) )
            {
              self::odgovori($sender, "Informacije o sustavu:\n Komande: rezerviraj, prihvati, odbij, verificiraj" );
              break;
            } 

        default:
            self::odgovori($sender, "Ne razumijem. Unesite komandu 'info'");
          break;
      }  
      
    }
    private function rezerviraj($username, $datum, $vrijeme,$sender)
    {
       try{
          $this->CI->load->model('dostupni');
          $this->CI->load->model('korisnik');
          $user_id = $this->CI->korisnik->get_id($username);
       } catch (Exception $e ){
         error_log($e);
       }
     
      if(!$user_id)
      {
        self::odgovori($sender, "Taj korisnik ne postoji, Koristi komandu XXXX Da nađeš tog korisnika");
        return;
      }
	  // Provjera jel se to zapravo rezervira u prošlosti
	  // TODO Format datuma
	  $danasnji_datum = Date("Y-m-d");
	  if($datum < $danasnji_datum)
	  {
		  self::odgovori($sender, "Nije moguce rezervirati termin u prošlosti, no time travelers!");
		  return;
	  }
	  
      if(!$this->CI->korisnik->has_fb_id($user_id) )
      {
        self::odgovori($sender, "Korisnik nije povezan s Facebookom");
        return;
      }
      if($this->CI->user_postavke->get_postavke($user_id)->dopusti_van_termina == "t")
      {
        $moguce_rezervirati = true;
      } else 
      {
        $moguce_rezervirati = $this->CI->dostupni->provjeri_dostupnost($user_id, $datum, $vrijeme);
      }
      
      if($moguce_rezervirati)
      {
        try{
            $this->CI->load->model('dogovoreni');
            
            $ne_poklapa_se = $this->CI->dogovoreni->provjeri_dostupnost($user_id, $datum, $vrijeme);
            if($ne_poklapa_se == true){
              $hash = $this->CI->dogovoreni->zapisi_termin($user_id, $datum, $vrijeme,$sender);
              if($this->CI->user_postavke->get_postavke($user_id)->automatsko_prihvacanje == "t"){
                  if($hash)
                    self::automatsko_prihvacanje($hash);
              } else {
                  if($hash)
                    self::obavjesti_korisnika($user_id,$datum,$vrijeme,$hash);
                  if($hash)
                    self::odgovori($sender, "Termin je ".$hash." zapisan, čeka se potvrda korisnika");
              }

            
          } else {
              self::odgovori($sender, "Termin se poklapa sa vec zapisanim");
          }
        } catch (Exception $e){
          error_log($e);
        }
      }
      else 
      {
          self::odgovori($sender, "Nema termina u to vrijeme." );
      }
    }
    private function verificiraj($token, $sender)
    {
      
            $this->CI->load->model("fbconnect");
            $id = $this->CI->fbconnect->check_token($token); 
            if($id){
              $this->CI->load->model("User_postavke");
              if( $this->CI->User_postavke->set_fb_id($id,$sender) )
              {
                self::odgovori($sender, "Uspiješno verificiran Facebook račun");
                $this->CI->fbconnect->delete_token($token); 

              } else {
                self::odgovori("Nepoznata pograška");
              };
              
            } else {
                self::odgovori($sender, "Krivi token za verifikaciju");
            }
              
    }
    private function obavjesti_korisnika($user_id, $datum, $vrijeme, $hash)
    {
      $this->CI->load->model("korisnik");
      $this->CI->load->library("mailovi");
      $korisnik = $this->CI->user_postavke->get_fb_id($user_id);
      $email = $this->CI->korisnik->get_email($user_id);
      
      $poruka = "Zelite li prihvatiti termin " . $hash ." dana " . $datum . " u vrijeme: ". $vrijeme . ".";

      $obavjesti = $this->CI->obavjesti->get_obavjesti($user_id);
      if($obavjesti->mail)
        $this->CI->mailovi->sendMail($email, "[Konzul] Imate novi termin", "Novi termin treba biti potvrđen, odite na ".base_url()." za potvrdu ili odbijanje termina.");
      if($obavjesti->face)  
        self::fb_gumbi($korisnik, $poruka, $hash);
    }
    private function automatsko_prihvacanje($hash)
    {
      $rezervirao = $this->CI->dogovoreni->get_sender($hash);
      if( $this->CI->dogovoreni->prihvati_termin($hash) )
        {
          self::odgovori($rezervirao, "Termin ". $hash ." prihvaćen");
        } else {
          
          self::odgovori($rezervirao, "Nepoznata greška prilikom prihvaćanja");
        }
    }
    private function prihvati($hash, $sender)
    {
      $this->CI->load->model("dogovoreni");
      if( $this->CI->dogovoreni->verificiraj_sendera_sa_hash($hash, $sender) )
      {
        if( $this->CI->dogovoreni->prihvati_termin($hash) )
        {
          self::odgovori($sender, "Termin ". $hash ." prihvaćen");
          $rezervirao = $this->CI->dogovoreni->get_sender($hash);
          self::odgovori($rezervirao, "Termin ". $hash ." prihvaćen");
        } else {
          self::odgovori($sender, "Nepoznata greška prilikom prihvaćanja");
        }
      }
      else 
      {
        self::odgovori($sender, "Taj termin ne postoji, ili nemate pravo pristupa za njega");
      }
    }
    private function odbij($hash, $sender)
    {
      $this->CI->load->model("dogovoreni");
      if( $this->CI->dogovoreni->verificiraj_sendera_sa_hash($hash, $sender) )
      {
        if( $this->CI->dogovoreni->odbij_termin($hash) )
        {
          self::odgovori($sender, "Termin ". $hash ." odbijen");
          $rezervirao = $this->CI->dogovoreni->get_sender($hash);
          self::odgovori($rezervirao, "Termin ". $hash ." odbijen");

        } else {
          self::odgovori($sender, "Nepoznata greška prilikom odbijanja");
        }
      } 
      else {
        self::odgovori($sender, "Taj termin ne postoji, ili nemate pravo pristupa za njega");
      }
    }
    private function fb_gumbi($sender, $message, $hash,  $vd = false)
    {
      error_log($message);
       $json = $this->CI->jsonmessages->createFbButtons($sender, $message, $hash);

       if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            if($vd) var_dump($json);
            else    echo $json;
            //$this->CI->sendapi->sendFacebook($json);
        } else {
            $this->CI->sendapi->sendFacebook($json);
        }
    }
    private function odgovori($sender, $message, $vd = false)
    {
       error_log($message);
       $json = $this->CI->jsonmessages->createTextMessage($sender, $message);

       if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            if($vd) var_dump($json);
            else    echo $json;
        } else {
            $this->CI->sendapi->sendFacebook($json);
        }
       
    }
    public function n_odgovori($sender, $message)
    {
        $json = $this->CI->jsonmessages->createTextMessage($sender, $message);
        $this->CI->sendapi->sendFacebook($json);
    }

  }
