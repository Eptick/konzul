<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('ion_auth');
        
    }

	public function index()
	{
        $data = array('style' => array('/vendors/fullcalendar/dist/fullcalendar.min.css'),
                      'script' => array('/vendors/moment/min/moment.min.js',
                                        '/vendors/fullcalendar/dist/fullcalendar.min.js'));
        $user = $this->ion_auth->user()->row();
        $data["username"] = $user->username;

		$this->load->view('dashboard/header',$data);
        $this->load->view('dashboard/sidebar', $data);

        $this->load->view("dashboard/index");

        $this->load->view('dashboard/footer',$data);
	}

    public function kalendar()
	{
		
		if($this->ion_auth->logged_in()){
			$this->ion_auth->logout();
		};
		$this->ion_auth->login("admin@admin.com","password", TRUE);
		$user = $this->ion_auth->user()->row();

        $data = array('style' => array('/vendors/fullcalendar/dist/fullcalendar.min.css'),
                      'script' => array('/vendors/moment/min/moment.min.js',
                                        '/vendors/fullcalendar/dist/fullcalendar.min.js',
                                        '/vendors/fullcalendar/dist/lang/hr.js',
										'js/kalendar_site.js'));
        
        $data["username"] = $user->username;
      

		$this->load->view('dashboard/header',$data);
        
        $this->load->view('dashboard/sidebar', $data);

        $this->load->view("dashboard/kalendar");

        $this->load->view('dashboard/footer',$data);
	}
}
