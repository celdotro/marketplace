<?php

namespace celmarket\AWB;

use celmarket\Dispatcher;

class AWBImport {

    /**
     * [RO] Seteaza un AWB pentru o comanda
     * [EN] Add an AWB for a specific order
     * @param $cmd
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function setAwb($cmd){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'setAwb';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}