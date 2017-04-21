<?php
  class Korisnik extends CI_model {
    public $username;
    public $id;

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
      $this->load->library("ion_auth");
    }
    public function get_id($username)
    {
        $sql = 'SELECT user_id FROM user_settings WHERE handle = ?';

        $query = $this->db->query($sql, $username ); 
        if($query->result()) return $query->result()[0]->user_id;
            return false;
    }
    public function has_fb_id($id)
    {
      $sql = 'SELECT facebook_id FROM user_settings WHERE user_id = ?';

        $query = $this->db->query($sql, $id ); 
        if($query->result()) return true;
            return false;
    }
    public function get_email($id)
    {
      return $this->ion_auth->user($id)->row()->email;
    }
    
  }
?>