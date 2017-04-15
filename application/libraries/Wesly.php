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
      //$json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);
      //$this->CI->sendapi->sendFacebook($json);

      $izrezano = explode(" ", $poruka);
      switch ($izrezano[0]) {
        case 'rezerviraj':
            if(!isset($izrezano[1]) || !isset($izrezano[2]) || !isset($izrezano[3]))
            {
              error_log("Treba unesti rezerviraj {username} {GGGG-MM-DD} {HH:MM:SS}");  
              $poruka = "Treba unesti rezerviraj {username} {GGGG-MM-DD} {HH:MM:SS}";
              $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);
              $this->CI->sendapi->sendFacebook($json);
              break;
            }
            $username = $izrezano[1];
            $datum = $izrezano[2];
            $vrijeme = $izrezano[3];
            
            self::rezerviraj($username, $datum, $vrijeme);
          break;
        case 'verificiraj':
            if( !isset($izrezano[1]) )
            {
              error_log("Treba unesi token za rezervaciju");
              $poruka = "Treba unesi token za rezervaciju";
              $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);
              $this->CI->sendapi->sendFacebook($json);
              break;
            }
            $token = $izrezano[1];
            self::verificiraj($token, $sender);
        break;
        default:
            $poruka = "Ne razumijem.";
              $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);
              $this->CI->sendapi->sendFacebook($json);
          break;
      }  
      
    }
    private function rezerviraj($username, $datum, $vrijeme)
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
        error_log("Taj korisnik ne postoji, Koristi komandu XXXX Da nađeš tog korisnika");
        $poruka = "Taj korisnik ne postoji, Koristi komandu XXXX Da nađeš tog korisnika";
        $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);
        $this->CI->sendapi->sendFacebook($json);
        return;
      }
      $moguce_rezervirati = $this->CI->dostupni->provjeri_dostupnost($user_id, $datum, $vrijeme);
      if($moguce_rezervirati)
      {
        try{
            $this->CI->load->model('dogovoreni');
          $ne_poklapa_se = $this->CI->dogovoreni->provjeri_dostupnost($user_id, $datum, $vrijeme);
          if($ne_poklapa_se == true){
            $hash = $this->CI->dogovoreni->zapisi_termin($user_id, $datum, $vrijeme);
            if($hash)
              self::obavjesti_korisnika($user_id,$datum,$vrijeme,$hash);
            
          } else {
            error_log( "Termin se poklapa sa vec zapisanim" );
            $poruka = "Termin se poklapa sa vec zapisanim";
            $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);
            $this->CI->sendapi->sendFacebook($json);
          }
        } catch (Exception $e){
          error_log($e);
        }
        
          
      }
      else 
      {
          error_log("Nema termina u to vrijeme.");
          $poruka = "Nema termina u to vrijeme.";
          $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);
          $this->CI->sendapi->sendFacebook($json);
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
                error_log("Uspiješno verificiran Facebook račun");
                $poruka = "Uspiješno verificiran Facebook račun";
                $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);
                $this->CI->sendapi->sendFacebook($json);
                $this->CI->fb_connect->delete_token($token); 
              } else {
                error_log("Nepoznata pogreška");
                $poruka = "Nepoznata pogreška";
                $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);
                $this->CI->sendapi->sendFacebook($json);
              };
              
            } else {
                error_log("Krivi token za verifikaciju");
                $poruka = "Krivi token za verifikaciju";
                $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);
                $this->CI->sendapi->sendFacebook($json);
            }
              
    }
    private function obavjesti_korisnika($user_id, $datum, $vrijeme, $hash)
    {
      $poruka = "Zelite li prihvatiti termin " . $hash ." dana " . $datum . " u vrijeme: ". $vrijeme . ", ukoliko zelite, posaljite, prihvati {kod}, ili odbij {kod}";
      $this->CI->load->model("User_postavke");
      $korisnik = $this->CI->user_postavke->get_fb_id($user_id);
      $json = $this->CI->jsonmessages->createTextMessage($korisnik, $poruka);
      
      $this->CI->sendapi->sendFacebook($json);
    }
  }
