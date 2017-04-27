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
    function generateRandomString($length = 10) {
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }
    public function get_prihvacene($user_id, $start, $end)
    {
        $this->load->model("user_postavke");
        $trajanje = $this->user_postavke->get_trajanje_termina($user_id);
        $sql = "SELECT hash, note, datum, vrijeme,(vrijeme + ? * interval '1 minute') as end, termin_id from dogovoreni_termini 
                  where user_id = ? and 
                  datum >= ? AND
                  datum <= ? AND
                  prihvacen != 'o';";
        $query = $this->db->query($sql, array(intval($trajanje), $user_id, $start, $end) );
        if( empty( $query->result() ) ) return false;
        return $query->result(); 
    }
    public function get_neodgovorene($user_id)
    {
        $this->load->model("user_postavke");
        $trajanje = $this->user_postavke->get_trajanje_termina($user_id);
        $sql = "SELECT hash, datum, vrijeme,(vrijeme + ? * interval '1 minute') as end, termin_id from dogovoreni_termini 
                  where user_id = ? AND
                  prihvacen = 'n';";
        $query = $this->db->query($sql, array(intval($trajanje), $user_id) );
        if( empty( $query->result() ) ) return false;
        return $query->result(); 
    }
    public function provjeri_dostupnost($user_id, $datum, $vrijeme)
    {
      $trajanje = $this->user_postavke->get_trajanje_termina($user_id);
      $trajanje = intval($trajanje);
      $sql = "SELECT * FROM dogovoreni_termini WHERE 
                        datum = ? AND 
                        vrijeme <= ? AND 
                        (vrijeme + ? * interval '1 minute') >= ? AND 
                        user_id = ? AND
                        prihvacen != 'o'";

      $query = $this->db->query($sql,array( $datum, $vrijeme, $trajanje, $vrijeme, $user_id ) );
      $sql2 = "SELECT * FROM dogovoreni_termini WHERE 
                        datum = ? AND 
                        vrijeme <= (? + ? * interval '1 minute') AND 
                        (vrijeme + ? * interval '1 minute') >= (? + ? * interval '1 minute') AND 
                        user_id = ? AND
                        prihvacen != 'o'";

      $query2 = $this->db->query($sql2,array( $datum, $vrijeme, $trajanje, $trajanje, $vrijeme, $trajanje, $user_id ) );  
      
      if(empty($query->result() ) && empty($query2->result() ) )
        return true;
      return false;
    }
    public function zapisi_termin($user_id, $datum, $vrijeme,$sender)
    {
      $hash = self::generateRandomString(4);
      $sql = "INSERT INTO dogovoreni_termini VALUES (default, default, ?, ?, ?, ?, null,?);";
      $query = $this->db->query($sql, array($datum, $vrijeme, $hash, intval($user_id),$sender) );
      if($query) return $hash;
      return false;

    }
    public function prihvati_termin($hash)
    {
      $sql = "UPDATE dogovoreni_termini SET prihvacen = 'p' WHERE hash = ?";
      $query = $this->db->query($sql, array($hash) );
      return $query;
    }
    public function odbij_termin($hash)
    {
      $sql = "UPDATE dogovoreni_termini SET prihvacen = 'o' WHERE hash = ?";
      $query = $this->db->query($sql, array($hash) );
      return $query;
    }
    public function get_sender($hash)
    {
      $sql = "SELECT sender FROM dogovoreni_termini WHERE hash = ?";
      $query = $this->db->query($sql, array($hash) );
      
      if(empty($query->result()) ) return false;
      return $query->result()[0]->sender;
    }
    public function verificiraj_sendera_sa_hash($hash, $sender)
    {
      $sql = "SELECT hash, facebook_id from dogovoreni_termini 
                left join user_settings on dogovoreni_termini.user_id = user_settings.user_id 
                where hash = ? AND user_settings.facebook_id = ?;";
      $query = $this->db->query($sql, array($hash, $sender) );
      if( empty( $query->result() ) ) return false;
      return true;
    }
    public function get_uskoro($datum, $sati, $za_koliko_sati = 2)
    {
  
        $sql = "SELECT hash,sender from dogovoreni_termini 
                  where prihvacen = 'n' AND
                  datum = ? AND
                  vrijeme < (? + (interval '1h' * ?));";
        $query = $this->db->query($sql, array($datum, $sati, $za_koliko_sati) );
        if( empty( $query->result() ) ) return false;
        return $query->result(); 
    }
    public function update_komentar($hash,$komentar)
    {
      $sql = "UPDATE dogovoreni_termini SET note = ? WHERE hash = ?";
      $query = $this->db->query($sql, array($komentar, $hash) );
      return $query;
    }
  }
?>