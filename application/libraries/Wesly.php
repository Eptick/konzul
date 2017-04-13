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

      var_dump($poruka);
      $izrezano = explode(" ", $poruka);  
      $username = $izrezano[1];
      $datum = $izrezano[2];
      $vrijeme = $izrezano[3];

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
  }
