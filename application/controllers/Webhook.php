<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {

	public function postReciveMessage(){
		$json = $this->input->raw_input_stream;
		$data = json_decode($json,TRUE);
		if($data["object"] == "page"){
			foreach( $data["entry"] as $entry)
			{
				$pageID = $entry["id"]; // OVo se valjda neće koristit nikad
				$vrijemeSlanja = $entry["time"];

				foreach( $entry["messaging"] as $event){

					if($event["message"]){
						self::processTextMessage($event);
					} else {
						echo "watafak happend";
					}
				}
			}

		}


		$this->output->set_header('HTTP/1.0 200 OK');
		echo "";
	}
	
	
	public function getInit()
	{
		$token = "konzulaplikacija";
		$get = $this->input->get();
		
		if($get["hub_mode"] == "subscribe" && $get["hub_verify_token"] == $token){
			echo $get["hub_challenge"];
		}
		
	}
	private function processTextMessage($message)
	{
		$this->load->library("wesly");
		$sender = $message["sender"]["id"]; // Pošiljatelj poruke
		$text = $message["message"]["text"];

		error_log($text);
		$this->wesly->reciveTextMessage($sender, $text);
	}
}
