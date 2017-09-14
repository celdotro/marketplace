<?php
namespace celmarket\Email;

use celmarket\Dispatcher;

class EmailContact {

    /**
     * [RO] Trimite mail continand raportul unui bug intalnit in sistem (https://github.com/celdotro/marketplace/wiki/Trimitere-raport-bug)
     * [EN] Send an email containing a report about a bug encountered in the system (https://github.com/celdotro/marketplace/wiki/Send-bug-report)
     * @param $message
     * @param $debug
     * @return mixed
     * @throws \Exception
     */
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