<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {

	public function getInit()
	{
		var_dump($this->input->get());
		
	}
}
