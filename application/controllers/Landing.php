<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }


	public function index()
	{
        $data = array('style' => array('/vendors/fullcalendar/dist/fullcalendar.min.css'),
                      'script' => array('/vendors/moment/min/moment.min.js',
                                        '/vendors/fullcalendar/dist/fullcalendar.min.js'));

		$this->load->view('dashboard/header',$data);
        $this->load->view('dashboard/sidebar');

        $this->load->view("dashboard/index");

        $this->load->view('dashboard/footer',$data);
	}
}
