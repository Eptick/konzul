<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('ion_auth','form_validation',"session"));


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

			$data['identity_login'] = array('name' => 'identity',
				'id'    => 'identity_login',
				"class" => "form-control",
				'type'  => 'text',
				'placeholder' => "Username",
				'value' => $this->form_validation->set_value('identity'),
			);
			$data['password_login'] = array('name' => 'password',
				'id'   => 'password_login',
				"class"=> "form-control",
				'type' => 'password',
				'placeholder' => "Password",
			);
			// ovdje se ispisuje forma
			/*
			 $data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
				'placeholder' => 'Ime:',
                'type'  => 'text',
				"required" => "required",
				"class"=> "form-control",
                'value' => $this->form_validation->set_value('first_name'),
            );
            $data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
				"class"=> "form-control",
				"required" => "required",
				'placeholder' => 'Prezime:',
                'value' => $this->form_validation->set_value('last_name'),
            ); */
            $data['identity'] = array(
                'name'  => 'identity_reg',
                'id'    => 'identity',
                'type'  => 'text',
				"class"=> "form-control",
				"required" => "required",
				'placeholder' => 'Username:',
                'value' => $this->form_validation->set_value('identity'),
            );
            $data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'email',
				"class"=> "form-control",
				"required" => "required",
				'placeholder' => 'Email:',
                'value' => $this->form_validation->set_value('email'),
            );
			/*
            $data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'type'  => 'text',
				"class"=> "form-control",
				'placeholder' => 'Tvrtka:',
                'value' => $this->form_validation->set_value('company'),
            ); */
            $data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
				"class"=> "form-control",
				"placeholder" => "Broj telefona",
				"pattern" => "\(\d{3}\)\d{2}-\d{3}-\d{4}",
				"data-inputmask" => "'mask' : '(999)99-999-9999'",
                'value' => $this->form_validation->set_value('phone'),
            );
            $data['password'] = array(
                'name'  => 'password_reg',
                'type'  => 'password',
				"class" => "form-control",
				"data-validate-length-range"=>"5,9",
				'placeholder' => 'Lozinka:',
				'required' => 'required'
            );
            $data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'type'  => 'password',
				"class"=> "form-control",
				'placeholder' => 'Potvrda_lozinke:',
				"required" => "required",
				"data-validate-linked"=>"password_reg"
            );
			if(!empty($this->session->reg_error)){
				$data['reg_errors'] = $this->session->reg_error;
				$this->session->unset_userdata("reg_error");
			}
				
		
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
		
		} 
		redirect('','refresh');				
	}
	public function register()
	{
		if ($this->ion_auth->logged_in() ) redirect('dashboard', 'refresh');

		$tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

		$this->form_validation->set_rules('phone', 'Br. Telefona', 'required');
        $this->form_validation->set_rules('identity_reg','Username','required|is_unique['.$tables['users'].'.'.$identity_column.']');
        $this->form_validation->set_rules('email', 'Email' , 'required|valid_email');
		$this->form_validation->set_rules('password_reg', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Potvrda lozinke', 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity_reg');
            $password = $this->input->post('password_reg');

            $additional_data = array(
                'phone'      => $this->input->post('phone')
            );
			$phone = $this->input->post('phone');
			$phone = preg_replace("/\(|\)|\-/", "", $phone);
			$additional_data["phone"] = $phone;
        }
		
        if ($this->form_validation->run() == true)
        {
			$id = $reg = $this->ion_auth->register($identity, $password, $email, $additional_data);
			if($id){
				// check to see if we are creating the user
				// redirect them back to the admin page
				$this->load->model("user_postavke");
				$this->load->model("obavjesti");
				$this->user_postavke->create_postavke($id,$identity);
				$this->obavjesti->create_obavjesti($id);

				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->ion_auth->login($identity,$password);
           		redirect(base_url() . "dashboard/help", 'refresh');
			}
        } 
		$this->session->set_userdata("reg_error" , (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))) );
		
		redirect(base_url() . "users/login#signup", 'refresh');

	}

}
