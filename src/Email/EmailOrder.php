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
}