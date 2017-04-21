<?php
  class Fbconnect extends CI_model {
    public $id;
    public $user_id;
    public $token;
    
    public function __construct()
    {
      parent::__construct();
      $this->load->database();
      $this->load->helper("string");
    }
    public function create_token($id)
    {
        $sql = "DELETE FROM fb_connect WHERE user_id = ?;";
        $query = $this->db->query($sql, array($id) );

        $token = random_string("alpha",5);

        $sql = "INSERT INTO fb_connect(user_id, token) values (?, ?)";
        $query = $this->db->query($sql, array($id, $token) );
        if($query) return $token;
        return $query;
    }
    public function check_token($token)
    {
        $sql = "SELECT * from fb_connect where token = ?";
        $query = $this->db->query($sql, array($token) );
        if(!$query->result())
        {
            return false;
        }
        return $query->result()[0]->user_id;
        
    }
    public function delete_token($token)
    {
        $sql = "DELETE FROM fb_connect WHERE token = ?";
        $query = $this->db->query($sql, array($token) );
    }
  }
?>