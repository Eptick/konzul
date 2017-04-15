<?php
  class Dostupni extends CI_model {
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
    // Glupo sam nazvao funkciju treba bit dodaj dostupnost ili slicno
    // This confusees me.
    public function dodaj_termin($dan, $start, $end, $user_id)
    {
        // TODO Prebaci na update
        $sql = "DELETE FROM dostupni_termini WHERE dan = ? AND user_id = ?";
        $query = $this->db->query($sql,array( $dan, $user_id));
        
       
        $sql = "INSERT INTO dostupni_termini VALUES(default, ?, ?, ?, ?);";
        $query = $this->db->query($sql, array($dan, $start, $end, $user_id) );

        if($query)
            return true;
        return false;
    }
    public function provjeri_dostupnost($user_id, $datum, $vrijeme)
    {
      $dan = date("D", strtotime($datum));
      $sql = 'SELECT * FROM dostupni_termini WHERE 
                        dan = ? AND 
                        vrijeme_pocetka <= ? AND 
                        vrijeme_kraja >= ? AND 
                        user_id = ?';

      $query = $this->db->query($sql,array( $dan, $vrijeme, $vrijeme, $user_id ) ); 
      
      if($query->result())
        return true;
      return false;
    }
  }
?>