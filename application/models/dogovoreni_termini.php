<?php
  class Dogovoreni_termini extends CI_model {
    public $username;
    public $datum;
    public $vrijeme;

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function provjeri_dostupnost($username, $datum, $vrijeme)
    {
      $navodnik = "'"; 
      $dat = date("D", strtotime($datum));
      $dan = $navodnik.$dat.$navodnik; // NOTE: upit mora izgledati ovak: select * from dostupni_termini where dan = 'Mon'. Date funkcija vraca samo Mon, pa spajam navodnike na njega da izgleda 'Mon' i to koristim u upitu.
      $vrijeme = $navodnik.$vrijeme.$navodnik; // NOTE: ista stvar s vremenom.
      $username = $navodnik.$username.$navodnik;
      $query = $this->db->query('SELECT * FROM dostupni_termini WHERE dan = '.$dan.' AND vrijeme_pocetka <= '.$vrijeme.' AND vrijeme_kraja >= '.$vrijeme.'AND user_id = (SELECT id FROM users WHERE username = '.$username.')'); 
      return $query->result();
    }

    public function dogovori_termin()
    {

    }
  }
?>