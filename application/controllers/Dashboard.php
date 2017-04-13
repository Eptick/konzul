<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('ion_auth');

        if(!$this->ion_auth->logged_in()){
            redirect('/','refresh');
		};
    }

	public function index()
	{
        $data = array('style' => array('/vendors/fullcalendar/dist/fullcalendar.min.css'),
                      'script' => array('/vendors/moment/min/moment.min.js',
                                        '/vendors/fullcalendar/dist/fullcalendar.min.js'));
        
        $user = $this->ion_auth->user()->row();
        $data["username"] = $user->username;

        $data["username"] = $user->username;

		$this->load->view('dashboard/header',$data);
        $this->load->view('dashboard/sidebar', $data);

        $this->load->view("dashboard/index");

        $this->load->view('dashboard/footer',$data);
	}

    public function kalendar()
	{
		
        $data = array('style' => array('/vendors/fullcalendar/dist/fullcalendar.min.css'),
                      'script' => array('/vendors/moment/min/moment.min.js',
                                        '/vendors/fullcalendar/dist/fullcalendar.min.js',
                                        '/vendors/fullcalendar/dist/lang/hr.js',
										'js/kalendar_site.js'));


        $user = $this->ion_auth->user()->row();
        $data["username"] = $user->username;

		$this->load->view('dashboard/header',$data);
        
        $this->load->view('dashboard/sidebar', $data);

        $this->load->view("dashboard/kalendar");

        $this->load->view('dashboard/footer',$data);
	}
    public function postavke()
    {
        $data = array('style'  => array('vendors/switchery/dist/switchery.min.css',
                                        'vendors/normalize-css/normalize.css',
                                        'vendors/ion.rangeSlider/css/ion.rangeSlider.css',
                                        'vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css'
                                        ),
                      'script' => array('vendors/moment/min/moment.min.js',
                                        'vendors/parsleyjs/dist/parsley.min.js',
                                        'vendors/switchery/dist/switchery.min.js',
                                        'vendors/ion.rangeSlider/js/ion.rangeSlider.min.js',
                                        'js/postavke.js'));

        $user = $this->ion_auth->user()->row();
        $data["username"] = $user->username;

        $this->load->view('dashboard/header',$data);
        $this->load->view('dashboard/sidebar', $data);

        $this->load->view("dashboard/postavke");

        $this->load->view('dashboard/footer',$data);
	
    }

}
