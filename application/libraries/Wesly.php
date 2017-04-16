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
    }

    public function reciveTextMessage($sender, $poruka)
    {
      $izrezano = explode(" ", $poruka);
      switch ($izrezano[0]) {
        case 'rezerviraj':
            if(!isset($izrezano[1]) || !isset($izrezano[2]) || !isset($izrezano[3]))
            {
              self::odgovori($sender,"Treba unesti rezerviraj {username} {GGGG-MM-DD} {HH:MM:SS}");
              break;
            }
            $username = $izrezano[1];
            $datum = $izrezano[2];
            $vrijeme = $izrezano[3];
            
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
        default:
            self::odgovori($sender, "Ne razumijem.");
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
      $moguce_rezervirati = $this->CI->dostupni->provjeri_dostupnost($user_id, $datum, $vrijeme);
      if($moguce_rezervirati)
      {
        try{
            $this->CI->load->model('dogovoreni');
            $ne_poklapa_se = $this->CI->dogovoreni->provjeri_dostupnost($user_id, $datum, $vrijeme);
            if($ne_poklapa_se == true){
              $hash = $this->CI->dogovoreni->zapisi_termin($user_id, $datum, $vrijeme,$sender);
              if($hash)
                self::obavjesti_korisnika($user_id,$datum,$vrijeme,$hash);
            
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
      
            $this->CI->load->model("Fb_connect");
            $id = $this->CI->fb_connect->check_token($token); 
            if($id){
              $this->CI->load->model("User_postavke");
              if( $this->CI->User_postavke->set_fb_id($id,$sender) )
              {
                self::odgovori($sender, "Uspiješno verificiran Facebook račun");
                $this->CI->fb_connect->delete_token($token); 

              } else {
                self::odgovori("Nepoznata pograška");
              };
              
            } else {
                self::odgovori($sender, "Krivi token za verifikaciju");
            }
              
    }
    private function obavjesti_korisnika($user_id, $datum, $vrijeme, $hash)
    {
      $this->CI->load->model("User_postavke");
      $korisnik = $this->CI->user_postavke->get_fb_id($user_id);

      $poruka = "Zelite li prihvatiti termin " . $hash ." dana " . $datum . " u vrijeme: ". $vrijeme . ", ukoliko zelite, posaljite, prihvati {kod}, ili odbij {kod}";
      self::odgovori($korisnik, $poruka);
    }

    private function prihvati($hash, $sender)
    {
      $this->CI->load->model("dogovoreni");
      if( $this->CI->dogovoreni->prihvati_termin($hash) )
      {
        self::odgovori($sender, "Termin ". $hash ." prihvaćen");
        $rezervirao = $this->CI->dogovoreni->get_sender($hash);
        self::odgovori($rezervirao, "Termin ". $hash ." prihvaćen");
      } else {
        self::odgovori($sender, "Nepoznata greška prilikom prihvaćanja");
      }

    }
    private function odbij($hash, $sender)
    {
      $this->CI->load->model("dogovoreni");
      if( $this->CI->dogovoreni->odbij_termin($hash) )
      {
        self::odgovori($sender, "Termin ". $hash ." odbijen");
        $rezervirao = $this->CI->dogovoreni->get_sender($hash);
        self::odgovori($rezervirao, "Termin ". $hash ." odbijen");

      } else {
        self::odgovori($sender, "Nepoznata greška prilikom odbijanja");
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

  }
