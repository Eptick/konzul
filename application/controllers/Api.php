<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('ion_auth');
    }


    public function termini()
	{
		if($this->ion_auth->logged_in()){
            $get = $this->input->get();
            
            // Početni i završni datum koji trebaju ić u kalendar
            // S ovim piši upite
            
            //$start = $get["start"];
            //$end = $get["end"];
			$id = $this->ion_auth->user()->row()->id;
            
            $response = array(
                array("id"    => "1",
                      "title" => "Naslov 1",
                      "start" => "2017-04-12"),

                array("id"    => "2",
                      "title" => "Naslov 2",
                      "start" => "2017-04-08T10:00:00",
                      "end" => "2017-04-08T19:00:00")
            );
            //header('Content-Type: application/json');
            echo json_encode( $response );

		} 
            else 
        {
            header('Content-Type: application/json');
            echo json_encode( "{}");
        }
	}
}
