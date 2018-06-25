<?php
namespace celmarket\Email;

use celmarket\Dispatcher;

class EmailContact {

    /**
     * [RO] Returneaza un graf cu conversatiile purtate prin intermediul email-ului cu clientii (hthttps://github.com/celdotro/marketplace/wiki/Trimitere-raport-bug)
     * [EN] Returns a graph with the conversations made through the email with the client (https://github.com/celdotro/marketplace/wiki/Send-bug-report)
     * @param $message
     * @param $debug
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendBugReport($message, $debug){
        // Sanity check
        if(is_null($message) || empty(trim($message)) || strlen(trim($message)) < 10) throw new \Exception('Specificati un mesaj valid de cel putin 10 caractere in afara de spatiu');
        if(empty($debug) && !is_array($debug)) throw new \Exception('Specificati mesajul de debug sub forma unui array');

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