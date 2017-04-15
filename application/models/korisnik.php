<?php
  class Korisnik extends CI_model {
    public $username;
    public $id;

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }
    public function get_id($username)
    {
        $sql = 'SELECT id FROM users WHERE username = ?';

        $query = $this->db->query($sql, $username ); 
        if($query->result()) return $query->result()[0]->id;
            return false;
    }
    
  }
?>