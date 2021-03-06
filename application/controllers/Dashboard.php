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
                                       'vendors/pnotify/dist/pnotify.nonblock.css'),
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
        $this->load->model("obavjesti");

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
        $postavke = $this->user_postavke->get_postavke($user->id);
        $obavjesti = $this->obavjesti->get_obavjesti($user->id);

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
        $data['postavke_info'] = array('name' => 'postavke_info',
                    'id'    => 'postavke_info',
                    "class" => "form-control col-md-7 col-xs-12",
                    'type'  => 'text',
                    'placeholder' => $postavke->info
            );


         $data['postavke_obavjesti_mail'] = array('name' => 'postavke_obavjesti_mail',
				'id'    => 'postavke_obavjesti_mail',
				"class" => "flat",
				'type'  => 'checkbox'
		    );
        if($obavjesti->mail == "1"){ $data['postavke_obavjesti_mail']["checked"] = "checked";   }


         $data['postavke_obavjesti_face'] = array('name' => 'postavke_obavjesti_face',
				'id'    => 'postavke_obavjesti_face',
				"class" => "flat",
				'type'  => 'checkbox'
		    );
        if($obavjesti->face == "1"){ $data['postavke_obavjesti_face']["checked"] = "checked";   }  
        $data['postavke_obavjesti_viber'] = array('name' => 'postavke_obavjesti_viber',
				'id'    => 'postavke_obavjesti_viber',
				"class" => "form-control col-md-7 col-xs-12",
				'type'  => 'number',
                "min"   => '00',
                "max"   => "23",
                "value" => "0"
		    );
         if($obavjesti->viber){ $data['postavke_obavjesti_viber']["value"] = $obavjesti->viber;   } 

         $data['postavke_obavjesti_sms'] = array('name' => 'postavke_obavjesti_sms',
				'id'    => 'postavke_obavjesti_sms',
				"class" => "form-control col-md-7 col-xs-12",
				'type'  => 'number',
                "min"   => '00',
                "max"   => "23",
                "value" => "0"
		    );
         if($obavjesti->sms){ $data['postavke_obavjesti_sms']["value"] = $obavjesti->sms;   } 



        $this->load->model("dostupni");

        if(true){
            // Mon, Tue, Wed, Thu, Fri, Sat, Sun
            $dani = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
            $inputi = array();
            foreach ($dani as $dan) {
                $dostupnost = $this->dostupni->get_dash_dopstupni($user->id, $dan);
                if($dostupnost){
                    $input = array('name' => 'range'.$dan,
                    'id'    => 'range'.$dan,
                    "class" => "vrijeme_od_do",
                    'type'  => 'text',
                    'data_from' => $dostupnost->od,
                    'data_to' => $dostupnost->do
                    );
                    array_push($inputi, $input);
                    $data['dostupnost_'.strtolower($dan)] = $input;
                    
                }
                    
            
            }
            $data["dostupnost_inputi"] = $inputi;
        }


        $this->load->view('dashboard/header',$data);
        $this->load->view('dashboard/sidebar', $data);

        $this->load->view("dashboard/postavke",$data);

        $this->load->view('dashboard/footer',$data);
	
    }

    public function help()
    {
        $data = array('style' => array('vendors/iCheck/skins/flat/green.css',
                                       'vendors/pnotify/dist/pnotify.css',
                                       'vendors/pnotify/dist/pnotify.buttons.css',
                                       'vendors/pnotify/dist/pnotify.nonblock.css',
                                       'css/help.css'),
                      'script' => array('/vendors/moment/min/moment.min.js',
                                        'vendors/pnotify/dist/pnotify.js',
                                        'vendors/pnotify/dist/pnotify.buttons.js',
                                        'vendors/pnotify/dist/pnotify.nonblock.js',
                                        'js/dashboard.js',
                                        'js/help.js'));
        
        $user = $this->ion_auth->user()->row();
        $data["username"] = $user->username;

        $data["username"] = $user->username;

		$this->load->view('dashboard/header',$data);
        $this->load->view('dashboard/sidebar', $data);

        $this->load->view("dashboard/help");

        $this->load->view('dashboard/footer',$data);
    }

}
