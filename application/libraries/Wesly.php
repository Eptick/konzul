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
              echo "Treba unesti rezerviraj {username} {GGGG-MM-DD} {HH:MM:SS}";
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
              echo "Treba unesi token za rezervaciju";
              break;
            }
            $token = $izrezano[1];
            self::verificiraj($token, $sender);
        break;
        default:
            echo "Ne razumijem";
          break;
      }  
      
    }
    private function rezerviraj($username, $datum, $vrijeme)
    {
      // 
      $this->CI->load->model('dostupni_termini');
      $this->CI->load->model('korisnik');
      $user_id = $this->CI->korisnik->get_id($username);
      if(!$user_id)
      {
        echo "Taj korisnik ne postoji, Koristi komandu XXXX Da nađeš tog korisnika";
        return;
      }
      $moguce_rezervirati = $this->CI->dostupni_termini->provjeri_dostupnost($user_id, $datum, $vrijeme);

      if($moguce_rezervirati)
      {
        $this->CI->load->model('dogovoreni_termini');
        $ne_poklapa_se = $this->CI->dogovoreni_termini->provjeri_dostupnost($user_id, $datum, $vrijeme);
        if($ne_poklapa_se == true){
          $hash = $this->CI->dogovoreni_termini->zapisi_termin($user_id, $datum, $vrijeme);
          if($hash)
            self::obavjesti_korisnika($user_id,$datum,$vrijeme,$hash);
          
        } else {
          echo "Termin se poklapa sa vec zapisanim";
        }
          
      }
      else 
      {
         echo "Nema termina u to vrijeme.";
      }
    }
    private function verificiraj($token, $sender)
    {
      
            $this->CI->load->model("fb_connect");
            $id = $this->CI->fb_connect->check_token($token); 
            if($id){
              $this->CI->load->model("user_settings");
              if( $this->CI->user_settings->set_fb_id($id,$sender) )
              {
                echo "Uspiješno verificiran Facebook račun";
                $this->CI->fb_connect->delete_token($token); 
              } else {
                echo "Nepoznata pogreška";
              };
              
            } else {
              echo "Krivi token za verifikaciju";
            }
              
    }
    private function obavjesti_korisnika($user_id, $datum, $vrijeme, $hash)
    {
      $poruka = "Zelite li prihvatiti termin " . $hash ." dana " . $datum . " u vrijeme: ". $vrijeme . ", ukoliko zelite, posaljite, prihvati {kod}, ili odbij {kod}";
      $this->CI->load->model("user_settings");
      $korisnik = $this->CI->user_settings->get_fb_id($user_id);
      
      $json = $this->CI->jsonmessages->createTextMessage($korisnik, $poruka);
      
      $this->CI->sendapi->sendFacebook($json);
    }
  }
