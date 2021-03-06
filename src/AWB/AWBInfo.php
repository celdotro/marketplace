<?php

namespace celmarket\AWB;

use celmarket\Dispatcher;

class AWBInfo {

    /**
     * [RO] Printeaza AWB-ul unei comenzi (https://github.com/celdotro/marketplace/wiki/Listare-AWB)
     * [EN] Prints the AWB of a specified order (https://github.com/celdotro/marketplace/wiki/AWB-Print)
     * @param $cmd
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function printAwb($cmd){
        // Sanity check
        if(!isset($cmd) || is_null($cmd) || $cmd === '' || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'printAwb';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Returneaza statusul unui AWB (https://github.com/celdotro/marketplace/wiki/Status-AWB)
     * [EN] Returns information about an AWB's status (https://github.com/celdotro/marketplace/wiki/AWB-Status)
     * @param $cmd
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function statusAwb($cmd){
        // Sanity check
        if(!isset($cmd) || is_null($cmd) || $cmd === '' || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'statusAwb';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}