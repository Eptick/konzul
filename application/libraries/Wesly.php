<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wesly {
        private $token = "EAAKtAJ0lxooBAEXjEXMsAwpPTiZAuBT1gIY97kEEmUeZBHRedJl8CHT8zLaeZA4s0vAeCZAkihPNYsx2R0FSr4swj1Xaxbh3zUDENyRF8a9Si8FeajzorUOvTvHGfN72Q0fUfU0QhF77JZBoYeKqG6BzvoeA67MbdUsgTIrb2OwZDZD";
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
                $this->CI->load->library('jsonMessages');
        }

        public function reciveTextMessage($sender, $poruka)
        {
            $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);

            $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$this->token;
            //Initiate cURL.
            $ch = curl_init($url);
            
            var_dump($json);
            //Tell cURL that we want to send a POST request.
            curl_setopt($ch, CURLOPT_POST, 1);
            //Attach our encoded JSON string to the POST fields.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            //Set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
            //Execute the request
            
            $result = curl_exec($ch);
            

        }
}