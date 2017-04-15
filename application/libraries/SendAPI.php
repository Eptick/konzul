<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendAPI {
        private $token = "EAAKtAJ0lxooBAFuZBADaBBupBwqZAQYKwB92Uxl1DaH3RSTkgVCXDbzLtfSdyBYtqusP8ZCi5VASnaUvALZCQZBJbb1EByq0kKkw53onLPLat1upJekI7ZBYaMrVThQtTZCz0zoLKeHzYKHWb8ZAxHTW9jV5B125oPkAZBayQ0YHANAZDZD";
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