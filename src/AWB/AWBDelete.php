<?php

namespace celmarket\AWB;

use celmarket\Dispatcher;

class AWBDelete {

    /**
     * [RO] Sterge AWB-ului unei comenzi (https://github.com/celdotro/marketplace/wiki/Stergere-AWB)
     * [EN] Delete the AWB of a specific order (https://github.com/celdotro/marketplace/wiki/AWB-Delete)
     * @param $cmd
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
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