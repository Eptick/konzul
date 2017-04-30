<?php
  class Kontekst extends CI_model {
    public function __construct()
    {
      parent::__construct();
      $this->load->database();
      $this->load->helper("string");
    }
    public function create_kontekst($sender, $komanda)
    {
        $sql = "DELETE FROM kontekst WHERE sender = ?;";
        $query = $this->db->query($sql, $sender );

        $sql = "INSERT INTO kontekst(sender, komanda) values (?, ?)";
        $query = $this->db->query($sql, array($sender, $komanda) );
        
    }
    public function get($sender)
    {
        $sql = "SELECT * from kontekst where sender = ?";
        $query = $this->db->query($sql, array($sender) );
        if(!$query->result())
        {
            return false;
        }
        return $query->result()[0];
        
    }
    public function set($sender,$brParametra, $parametar)
    {
        $sql = "UPDATE TABLE kontekst SET par".$brParametra." = ? WHERE sender = ?";
        $query = $this->db->query($sql, array($parametar, $sender) );

    }
    public function count($sender)
    {
        $sql = "SELECT * from kontekst where sender = ?";
        $query = $this->db->query($sql, array($sender) );
        if(!$query->result())
        {
            return false;
        }
        $dan = $query->result()[0];
        $brojParametara = 0;
        if( isset($dan->par1) ) $brojParametara += 1;
        if( isset($dan->par2) ) $brojParametara += 1;
        if( isset($dan->par3) ) $brojParametara += 1;
        if( isset($dan->par4) ) $brojParametara += 1;
        if( isset($dan->par5) ) $brojParametara += 1;
        return $brParametra;
    }
    public function delete_kontekst($sender)
    {
        $sql = "DELETE FROM kontekst WHERE sender = ?";
        $query = $this->db->query($sql, array($sender) );
    }
  }
?>