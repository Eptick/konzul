<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('ion_auth');
    }

	public function index()
	{
		redirect("users/login");
	}
	public function login() 
	{

		$this->load->library("ion_auth");

		$this->load->view("auth2/header");

		$this->load->view("auth2/login");
		
		$this->load->view("auth2/footer");
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
}
