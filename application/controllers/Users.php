<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('ion_auth','form_validation'));


		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

    }

	public function index()
	{
		redirect("users/login");
	}
	public function login() 
	{
		$this->form_validation->set_rules('identity','Username', 'required');
		$this->form_validation->set_rules('password','Password', 'required');
        
		if($this->form_validation->run() == TRUE)
		{

			// Ovdje se vrti validacija
			if ($this->ion_auth->login(
				$this->input->post('identity'), 
				$this->input->post('password'), TRUE))
			{
				// Uspriješno logiranje
				// redirect na dashboard
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('dashboard', 'refresh');
			}
			else
			{
				// Neuspiješan login
				// Vrati nazad na login, al s porukama
				$this->session->set_flashdata('message', $this->ion_auth->errors());

				redirect('users/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}

		}
		 else
		{
			// Ispiši error poruke ako ih ima
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				"class" => "form-control",
				'type'  => 'text',
				'placeholder' => "Username",
				'value' => $this->form_validation->set_value('identity'),
			);
			$data['password'] = array('name' => 'password',
				'id'   => 'password',
				"class"=> "form-control",
				'type' => 'password',
				'placeholder' => "Password",
			);
			// ovdje se ispisuje forma
		
			$this->load->view("auth2/header");
			$this->load->view("auth2/login",$data);
			$this->load->view("auth2/footer");

		}

	}
	public function logout()
	{
		

		if( $this->ion_auth->logged_in() )
		{
			$this->ion_auth->logout();
			redirect("","refresh");
		} 
		else 
		{
			redirect('','refresh');				
		}
	}
	public function register()
	{
		
	}

}
