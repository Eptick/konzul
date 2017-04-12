<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->helper("url");
		redirect("users/login");
	}
	public function login() 
	{
		$this->load->helper("url");
		$this->load->library("ion_auth");

		$this->load->view("auth2/header");

		$this->load->view("auth2/login");

		$this->load->view("auth2/footer");
	}
}
