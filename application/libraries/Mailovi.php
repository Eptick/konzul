<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailovi {
        private $API_KEY = "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";
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
                
        }
        public function sendMail($send_to, $subject,  $message)
        {
                $from = new SendGrid\Email(null, "obavjesti@konzultiraj.me");
                //$subject = "Hello World from the SendGrid PHP Library!";
                $to = new SendGrid\Email(null, $send_to);
                $content = new SendGrid\Content("text/plain", $message);
                $mail = new SendGrid\Mail($from, $subject, $to, $content);

                $sg = new \SendGrid($this->API_KEY);

                $response = $sg->client->mail()->send()->post($mail);
                /*
                echo $response->statusCode();
                echo $response->headers();
                echo $response->body(); */
        }

}