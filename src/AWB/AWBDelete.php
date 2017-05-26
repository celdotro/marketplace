<?php

namespace celmarket\AWB;

use celmarket\Dispatcher;

class AWBDelete {

    /**
     * Delete the AWB of a specific order
     * @param $cmd
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function deleteAwb($cmd){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'deleteAwb';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}