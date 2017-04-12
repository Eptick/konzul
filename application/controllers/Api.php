<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('ion_auth');
    }


    public function termini()
	{
		if($this->ion_auth->logged_in()){

			$id = $this->ion_auth->user()->row()->id;
            
		};
	}
}
