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
        public function createFbButtons($sendTo, $text, $hash)
        {
            /*
            "recipient":{
                "id":"USER_ID"
            },
            "message":{
                "attachment":{
                    "type":"template",
                    "payload":{
                        "template_type":"button",
                        "text":"What do you want to do next?",
                        "buttons":[
                        {
                            "type":"web_url",
                            "url":"https://petersapparel.parseapp.com",
                            "title":"Show Website"
                        },
                        {
                            "type":"postback",
                            "title":"Start Chatting",
                            "payload":"USER_DEFINED_PAYLOAD"
                        }
                        ]
                    }
                }
            } */
            $json = array(
                'recipient' => array('id' => $sendTo),
                'message' => array(
                    "attachment" => array(
                        "type" => "template",
                        "payload" => array(
                            "template_type" => "button",
                            "text" => $text,
                            "buttons" => array(array("type" => "web_url",
                                                     "url" => base_url()."/api/prihvati/".$hash,
                                                     "title" => "Prihvati"),
                                                array("type" => "web_url",
                                                     "url" => base_url()."/api/odbij/".$hash,
                                                     "title" => "Odbij"))
                        )
                ))
            );
            $encoded_json = json_encode($json);
            var_dump($json);
            return $encoded_json;
        }
}