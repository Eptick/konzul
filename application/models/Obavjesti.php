<?php
  class Obavjesti extends CI_model {
    public $id;
    public $user_id;
    public $mail;
    public $face;
    public $viber;
    public $sms;
    
    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }
    public function create_obavjesti($user_id)
    {
        $sql = "INSERT INTO obavjesti(user_id) values (?);";
        $query = $this->db->query($sql, array( intval($user_id) ) );
        return $query;
    }
    public function get_obavjesti($user_id)
    {
      $sql = "SELECT mail, face, viber, sms FROM obavjesti WHERE user_id = ?";
        $query = $this->db->query($sql, array(intval($user_id)) );
        
        if(empty($query->result()) ) return false;
        return $query->result()[0];
    }
    public function get_obavjesti_viber($sati)
    {
        $sql = "SELECT user_id FROM obavjesti WHERE viber = ?";
        $query = $this->db->query($sql, array($sati) );
        
        if(empty($query->result()) ) return false;
        return $query->result();
    }
    public function get_obavjesti_sms($sati)
    {
        $sql = "SELECT user_id FROM obavjesti WHERE sms = ?";
        $query = $this->db->query($sql, array($sati) );
        
        if(empty($query->result()) ) return false;
        return $query->result();
    }
    public function set_obavjesti($mail, $face, $viber, $sms, $user_id)
    {
        if($mail)  $mail  = intval($mail);
        if($face)  $face  = intval($face);
        if($viber) $viber = intval($viber);
        if($sms)   $sms   = intval($sms);

        $sql = "UPDATE obavjesti SET mail = ?, face = ?, viber = ?, sms = ? WHERE user_id = ?";
        $query = $this->db->query($sql, array($mail,
                                              $face,
                                              $viber,
                                              $sms, 
                                              intval($user_id)) );
        return $query;
    }
  }
?>