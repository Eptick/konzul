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
        $data = array('style' => array('vendors/iCheck/skins/flat/green.css',
                                       'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
                                       'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
                                       'vendors/pnotify/dist/pnotify.css',
                                       'vendors/pnotify/dist/pnotify.buttons.css',
                                       'vendors/pnotify/dist/pnotify.nonblock.css',
                                       'css/dashboard.css'),
                      'script' => array('/vendors/moment/min/moment.min.js',
                                        'vendors/iCheck/icheck.min.js',
                                        'vendors/datatables.net/js/jquery.dataTables.min.js',
                                        'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
                                        'vendors/pnotify/dist/pnotify.js',
                                        'vendors/pnotify/dist/pnotify.buttons.js',
                                        'vendors/pnotify/dist/pnotify.nonblock.js',
                                        'js/dashboard.js'));
        
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
        $this->load->helper("form");
        $this->load->model("user_postavke");

        $data = array('style'  => array('vendors/switchery/dist/switchery.min.css',
                                        'vendors/normalize-css/normalize.css',
                                        'vendors/ion.rangeSlider/css/ion.rangeSlider.css',
                                        'vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css',
                                        'vendors/iCheck/skins/flat/green.css'
                                        ),
                      'script' => array('vendors/moment/min/moment.min.js',
                                        'vendors/switchery/dist/switchery.min.js',
                                        'vendors/ion.rangeSlider/js/ion.rangeSlider.min.js',
                                        'vendors/iCheck/icheck.min.js',
                                        'js/postavke.js'));

        $user = $this->ion_auth->user()->row();
        $data["username"] = $user->username;
        $postavke = $this->user_postavke->get_postavke($this->ion_auth->user()->row()->id);

        $data['postavke_handle'] = array('name' => 'postavke_handle',
				'id'    => 'postavke_handle',
				"class" => "form-control col-md-7 col-xs-12",
				'type'  => 'text',
				'placeholder' => $postavke->handle
		);
        if($postavke->automatsko_prihvacanje == "t")
        {
             $data['postavke_automatsko_prihvacanje'] = array('name' => 'postavke_automatsko_prihvacanje',
				'id'    => 'postavke_automatsko_prihvacanje',
				"class" => "flat",
				'type'  => 'checkbox',
                "checked" => "checked"
		    );
        } else {
            $data['postavke_automatsko_prihvacanje'] = array('name' => 'postavke_automatsko_prihvacanje',
				'id'    => 'postavke_automatsko_prihvacanje',
				"class" => "flat",
				'type'  => 'checkbox',
		    );
        }
        $data['postavke_trajanje'] = array('name' => 'postavke_trajanje',
				'id'    => 'postavke_trajanje',
				"class" => "form-control col-md-7 col-xs-12",
				'type'  => 'number',
				'value' => $postavke->trajanje_termina
		);
        if($postavke->dopusti_van_termina == "t")
        {
             $data['postavke_dopusti_van_termina'] = array('name' => 'postavke_dopusti_van_termina',
				'id'    => 'postavke_dopusti_van_termina',
				"class" => "flat",
				'type'  => 'checkbox',
                "checked" => "checked"
		    );
        } else {
            $data['postavke_dopusti_van_termina'] = array('name' => 'postavke_dopusti_van_termina',
				'id'    => 'postavke_dopusti_van_termina',
				"class" => "flat",
				'type'  => 'checkbox',
		    );
        }


        $this->load->view('dashboard/header',$data);
        $this->load->view('dashboard/sidebar', $data);

        $this->load->view("dashboard/postavke");

        $this->load->view('dashboard/footer',$data);
	
    }

}
