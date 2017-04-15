<?php
  class Dogovoreni extends CI_model {
    public $username;
    public $datum;
    public $vrijeme;

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
      $this->load->model("user_postavke");
      $this->load->helper("string");
    }
    public function provjeri_dostupnost($user_id, $datum, $vrijeme)
    {
      $trajanje = $this->user_postavke->get_trajanje_termina($user_id);
      $trajanje = intval($trajanje);
      $sql = "SELECT * FROM dogovoreni_termini WHERE 
                        datum = ? AND 
                        vrijeme <= ? AND 
                        (vrijeme + ? * interval '1 minute') >= ? AND 
                        user_id = ?";

      $query = $this->db->query($sql,array( $datum, $vrijeme, $trajanje, $vrijeme, $user_id ) );
      $sql2 = "SELECT * FROM dogovoreni_termini WHERE 
                        datum = ? AND 
                        vrijeme <= (? + ? * interval '1 minute') AND 
                        (vrijeme + ? * interval '1 minute') >= (? + ? * interval '1 minute') AND 
                        user_id = ?";

      $query2 = $this->db->query($sql2,array( $datum, $vrijeme, $trajanje, $trajanje, $vrijeme, $trajanje, $user_id ) );  
      
      if(empty($query->result() ) && empty($query2->result() ) )
        return true;
      return false;
    }
    public function zapisi_termin($user_id, $datum, $vrijeme)
    {
      $hash = random_string("alpha",8);
      $sql = "INSERT INTO dogovoreni_termini VALUES (default, default, ?, ?, ?, ?, null);";
      $query = $this->db->query($sql, array($datum, $vrijeme, $hash, intval($user_id)) );
      if($query) return $hash;
      return false;

    }
    
  }
?>