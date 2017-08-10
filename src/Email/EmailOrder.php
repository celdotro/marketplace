<?php
namespace celmarket\Email;

use celmarket\Dispatcher;

class EmailOrder {

    /**
     * @return mixed
     */
    public function getOrderEmailList(){
        // Set method and action
        $method = 'email';
        $action = 'getOrderEmailList';

        // Set data
        $data = array('params' => true);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * @param $cmd
     * @return mixed
     * @throws \Exception
     */
    public function getClientEmailsForOrder($cmd){
        // Sanity check
        if (is_null($cmd) || !is_numeric($cmd)) throw new \Exception('Specificati o comanda valida');

        // Set method and action
        $method = 'email';
        $action = 'getClientEmailsForOrder';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * @param $cmd
     * @param $idEmail
     * @return mixed
     * @throws \Exception
     */
    public function sendOrderEmail($cmd, $idEmail){
        // Sanity check
        if (is_null($cmd) || !is_numeric($cmd)) throw new \Exception('Specificati o comanda valida');
        if (is_null($idEmail) || !is_numeric($idEmail)) throw new \Exception('Specificati un ID valid de email');

        // Set method and action
        $method = 'email';
        $action = 'sendOrderEmail';

        // Set data
        $data = array('cmd' => $cmd, 'idEmail' => $idEmail);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * @param $cmd
     * @param $subject
     * @param $body
     * @param null $replyID
     * @return mixed
     * @throws \Exception
     */
    public function sendOrderCustomEmail($cmd, $subject, $body, $replyID = null){
        // Sanity check
        if (is_null($cmd) || !is_numeric($cmd)) throw new \Exception('Specificati o comanda valida');
        if (is_null($subject) || $subject == '') throw new \Exception('Specificati un subiect valid');
        if (is_null($body) || $body == '') throw new \Exception('Specificati un continut valid');

        // Set method and action
        $method = 'email';
        $action = 'sendOrderCustomEmail';

        // Set data
        $data = array('cmd' => $cmd, 'subject' => $subject, 'body' => $body);
        if(!is_null($replyID)) $data['replyID'] = $replyID;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}