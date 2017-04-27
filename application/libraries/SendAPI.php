<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendAPI {
        private $token = "EAAVhxyvTCvIBAMwTiaDKGsa7l1wivpwScR2SgHMN0H1WZAZAZA3BFS4FXfZB2HzYsekU3oeM1KMAwXR2rTY2TlkyQkKskBNwYjdBycHF9YZAjTevexle23lBmZAWkBYyL2pUvFZCTso8FobdYEijd9pQYQ47N5BTbDbo0FgBpmcuwZDZD";
        private $nth_user = "pehpe";
        private $nth_pass = "2TP_~g#a+K6^+~z=";
        private $auth_string = null;
        private $nth_url =  "https://omni1.mobile-gw.com:9010/v1/omni/message";
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
                $this->auth_string = $this->nth_user.":".$this->nth_pass;
                $this->auth_string = base64_encode($this->auth_string);
                
        }

        public function sendFacebook($json)
        {
            $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$this->token;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $result = curl_exec($ch);
        }
        public function sendViberOrSms($json)
        {
                $ch = curl_init($this->nth_url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_VERBOSE, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $verbose = fopen('errorlog.txt', 'w+');
                curl_setopt($ch, CURLOPT_STDERR, $verbose);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                                           'Authorization: Basic '.$this->auth_string));
                $result = curl_exec($ch);
                var_dump($result);
        }
}