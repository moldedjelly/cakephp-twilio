<?php

namespace Twilio;

use Cake\Core\Configure;
use Twilio\Rest\Client;

class Twilio {

    private $__accountSid = null;
    private $__authToken = null;
    private $__instance = null;


    public function __construct() {
        $this->getInstance(Configure::read('Twilio.sid'), Configure::read('Twilio.token'));
    }

    public function getInstance($accountSid = null, $authToken = null) {
        if (!empty($accountSid) && !empty($authToken)) {
            $this->__accountSid = $accountSid;
            $this->__authToken = $authToken;
            //$this->__instance = new Services_Twilio($this->__accountSid, $this->__authToken);
            $this->__instance = new Twilio\Rest\Client($this->__accountSid, $this->__authToken);
        }
        return $this->__instance;
    }

    public function getUniqueCode($len = 4, $symbols = "0123456789") {
        $code = '';
        for ($i = 0; $i < $len; $i++) {
            $code .= $symbols[rand(0, strlen($symbols) - 1)];
        }
        return $code;
    }


    public function sendSMS($from, $to, $text) {
        $message = $this->__instance->messages->create(
            $to,
            array(
              'from' => $from,
              'body' => $text
            ));
        return $message->sid;
    }

    public function call($from, $to) {

    }
}
