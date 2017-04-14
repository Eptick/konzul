<?php
  class Dostupni_termini extends CI_model {
    public $dostupni_termini_id;
    public $dan;
    public $vrijeme_pocetka;
    public $vrijeme_kraja;
    public $user_id;
    
    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }
    public function dodaj_termin($dan, $start, $end, $user_id)
    {
        $sql = "DELETE FROM dostupni_termini WHERE dan = ? AND user_id = ?";
        $query = $this->db->query($sql,array( $dan, $user_id));
        
        var_dump($dan);
        $sql = "INSERT INTO dostupni_termini VALUES(default, ?, ?, ?, ?);";
        $query = $this->db->query($sql, array($dan, $start, $end, $user_id) );

    }
  }
?>