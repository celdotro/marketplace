<?php

namespace celmarket\AWB;

use celmarket\Dispatcher;

class AWBImport {

    /**
     * [RO] Seteaza un AWB pentru o comanda (https://github.com/celdotro/marketplace/wiki/Creare-AWB)
     * [EN] Add an AWB for a specific order (https://github.com/celdotro/marketplace/wiki/AWB-Import)
     * @param $cmd
     * @param null $idAdresaRidicare
     * @return mixed
     * @throws \Exception
     */
    public function importAWB($cmd, $awb, $idAdresaRidicare){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'setAwb';

        // Set data
        $data = array('cmd' => $cmd, 'awb' => $awb, 'idAdresaRidicare' => $idAdresaRidicare);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}