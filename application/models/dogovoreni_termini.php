<?php
  class Dogovoreni_termini extends CI_model {
    public $username;
    public $datum;
    public $vrijeme;

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    
  }
?>