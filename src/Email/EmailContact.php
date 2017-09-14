<?php
namespace celmarket\Email;

use celmarket\Dispatcher;

class EmailContact {

    public function sendBugReport($message, $debug){
        // Sanity check
        if(is_null($message) || empty(trim($message)) || strlen(trim($message)) < 10) throw new \Exception('Specificati un mesaj valid de cel putin 10 caractere in afara de spatiu');
        if(empty($debug)) throw new \Exception('Specificati mesajul de debug');

        // Set method and action
        $method = 'email';
        $action = 'sendBugReport';

        // Set data
        $data = array('message' => $message, 'debug' => $debug);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}