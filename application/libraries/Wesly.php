<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wesly {
        private $token = "EAAKtAJ0lxooBALTgxwZCZAQdabsnm9B4P13XywX5IxXjlkjgKwSaRZAOCWcjr7nXnWvfGinXnJIwHdUQfsl6mJtCkRLlgqtkjxlPPHoclRn53BgBZCIgyGnh7EeN3IHwbLi1hp9icNjV7BkAREbh73ZCwNJGH7bHH5UA45W8ywAZDZD";
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
                $this->CI->load->library('jsonMessages');
        }

        public function reciveTextMessage($sender, $poruka)
        {
            $json = $this->CI->jsonmessages->createTextMessage($sender, $poruka);

            $url = "https://graph.facebook.com/v2.6/me/messages?access_token" . $this->token;    

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: application/json' )); 
        
            $json_response = curl_exec($ch);

            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ( $status != 201 ) {
                die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($ch) . ", curl_errno " . curl_errno($ch));
            }


            curl_close($ch);

            $response = json_decode($json_response, true);
            var_dump($response);

        }
}