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
        
        if(empty($query->result()) ) return false;

        return $query->result()[0];
    }
    public function set_postavke($handle, $trajanje, $automatsko, $van, $id)
    {
      if( strlen($handle) > 0 ){
        $sql = "UPDATE user_settings SET handle = ? WHERE user_id = ?";
        $query = $this->db->query($sql, array($handle, $id) );
      }
      $sql = "UPDATE user_settings SET trajanje_termina    = ?, 
                                    automatsko_prihvacanje = ?,
                                    dopusti_van_termina    = ?  WHERE user_id = ?";
      $query = $this->db->query($sql, array($trajanje, $automatsko, $van, $id) ); 
    }

    public function create_postavke($id, $handle)
    {
        $sql = "INSERT INTO user_settings(user_id, handle) values (?, ?)";
        $query = $this->db->query($sql, array($id, $handle) );
        return $query;
    }
    public function set_fb_id($id, $fb_id)
    {
      $sql = "UPDATE user_settings SET facebook_id = ? WHERE user_id = ?";
      $query = $this->db->query($sql, array($fb_id, $id) );
      return $query;
    }
    public function get_fb_id($user_id)
    {
        $sql = "SELECT facebook_id FROM user_settings WHERE user_id = ?";
        $query = $this->db->query($sql, array($user_id) );
        
        if(empty($query->result()) ) return false;

        return $query->result()[0]->facebook_id;
    }
    public function get_trajanje_termina($user_id)
    {
          $sql = "SELECT trajanje_termina FROM user_settings WHERE user_id = ?";
            $query = $this->db->query($sql, array($user_id) );
            
            if(empty($query->result()) ) return false;

            return $query->result()[0]->trajanje_termina;
    }
  }
?>