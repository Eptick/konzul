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
      

      $this->CI->load->model('dogovoreni_termini');
      $rezultat = $this->CI->dogovoreni_termini->provjeri_dostupnost($username, $datum, $vrijeme);
      $broj_redova = count($rezultat);
      if($broj_redova != 0)
      {
        foreach ($rezultat as $row)
        {
        echo "<br>".$row->dostupni_termini_id;
        echo "<br>".$row->dan;
        echo "<br>".$row->vrijeme_pocetka;
        echo "<br>".$row->vrijeme_kraja;
        echo "<br>".$row->user_id;
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
  }
