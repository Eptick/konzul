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
            return $encoded_json;

        }
        public function createViberMessage($numbers)
        {
          $json = array(
                'channels' => array("VIBER"),
                //'destinations' => array("text" => $text)
                'viber' => array(
                        'text'          => 'Imate neodgovorenih termina',
                        "expiryText"    => "Viber expiry text",
                        "ttl"           => 3600,
                        "buttonCaption" => "Konzul",
                        "buttonAction"  => "https://konzul.herokuapp.com/",
                )
            );  
            $destinations = array();
            foreach ($numbers as $number) {
                array_push($destinations, array("phoneNumber" => $number) );
            }
            $json["destinations"] = $destinations;
            $encoded_json = json_encode($json);
            return $encoded_json;
        }
        public function createSMSMessage($numbers)
        {
          $json = array(
                'channels' => array("SMS"),
                //'destinations' => array("text" => $text)
                'sms' => array(
                        'sender'          => 'Konzul',
                        "text"    => "Imate nepotvrđenih termina https://konzul.herokuapp.com"
                )
            );  
            $destinations = array();
            foreach ($numbers as $number) {
                array_push($destinations, array("phoneNumber" => $number) );
            }
            $json["destinations"] = $destinations;
            $encoded_json = json_encode($json);
            return $encoded_json;
        }
}