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
      $dan = date("D", strtotime($datum));
      $sql = 'SELECT * FROM dostupni_termini WHERE 
                        dan = ? AND 
                        vrijeme_pocetka <= ? AND 
                        vrijeme_kraja >= ? AND 
                        user_id = (SELECT id FROM users WHERE username = ?)';

      $query = $this->db->query($sql,array( $dan, $vrijeme, $vrijeme, $username ) ); 
      return $query->result();
    }
  }
?>