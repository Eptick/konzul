<?php
  class user_settings extends CI_model {
    public $id;
    public $trajanje_termina;
    public $facebook_id;
    public $automatsko_prihvacanje;
    public $dopusti_van_termina;
    public $user_id;
    public $handle;
    
    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }
    public function get_postavke($user_id)
    {
        $sql = "SELECT * FROM user_settings WHERE user_id = ?";
        $query = $this->db->query($sql, array($user_id) );
        
        if(empty($query) ) return false;

        return $query[0];
    }
    public function set_postavke($trajanje, $prihvacanje, $dopusti, $user_id)
    {
        return "";
    }

    public function create_postavke($id, $handle)
    {
        $sql = "INSERT INTO user_settings(user_id, handle) values (?, ?)";
        $query = $this->db->query($sql, array($id, $handle) );
        return $query;
    }
  }
?>