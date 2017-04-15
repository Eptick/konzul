<?php
  class Fb_connect extends CI_model {
    public $id;
    public $user_id;
    public $token;
    
    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }
    private function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
    {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }
    public function create_token($id)
    {
        $sql = "DELETE FROM fb_connect WHERE user_id = ?;";
        $query = $this->db->query($sql, array($id) );

        $token = self::randString(5);

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