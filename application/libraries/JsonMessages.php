<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JsonMessages {
        
        public function createTextMessage($sendTo, $text)
        {
            /*
            {
                recipient: {
                    id: recipientId
                },
                message: {
                    text: messageText
                }
            }; 
            **/
            $json = array(
                'recipient' => array('id' => $sendTo),
                'message' => array("text" => $text)
            );

            $encoded_json = json_encode($json);

            var_dump($encoded_json);
            return $encoded_json;

        }
}