<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {

	public function getInit()
	{
		$token = "konzulaplikacija";
		$get = $this->input->get();
		if($get["hub_mode"] == "subscribe" && $get["hub_verify_token"] == $token){
			echo $get["hub_challenge"];
		}
		
	}
}
