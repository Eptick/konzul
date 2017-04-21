<?php
  class Korisnik extends CI_model {
    public $username;
    public $id;

    public function __construct()
    {
      parent::__construct();
      // komentar koji ce mjenjat file
      $this->load->database();
    }
    public function get_id($username)
    {
        $sql = 'SELECT user_id FROM user_settings WHERE handle = ?';

        $query = $this->db->query($sql, $username ); 
        if($query->result()) return $query->result()[0]->id;
            return false;
    }
    
  }
?>