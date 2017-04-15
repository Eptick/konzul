<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendAPI {
        private $token = "EAAY0ngyrL58BAKAcYJBrrreQSWVTkHpkwP5ZCO3HuKcdn97pUyND4PIBFZCXeY8kKxI2jZBZAADqRS7tlkZB3ZAGNrFwZBA5fCpNSo1JrLZAt7quBYHOb2nx7Cn4y9TGyPlgnQKFAJpxtx234QVDeqGSbhS1nodWPj11DLDwlRCUZCAZDZD";
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