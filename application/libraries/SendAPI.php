<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendAPI {
        private $token = "EAAVhxyvTCvIBAMwTiaDKGsa7l1wivpwScR2SgHMN0H1WZAZAZA3BFS4FXfZB2HzYsekU3oeM1KMAwXR2rTY2TlkyQkKskBNwYjdBycHF9YZAjTevexle23lBmZAWkBYyL2pUvFZCTso8FobdYEijd9pQYQ47N5BTbDbo0FgBpmcuwZDZD";
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
        }

        public function sendFacebook($json)
        {
            $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$this->token;
            
            $ch = curl_init($url);
            
             $fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_STDERR, $fp);
            $result = curl_exec($ch);
        }
}