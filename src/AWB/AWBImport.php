<?php

namespace celmarket\AWB;

use celmarket\Dispatcher;

class AWBImport {

    /**
     * [RO] Seteaza un AWB pentru o comanda (https://github.com/celdotro/marketplace/wiki/Creare-AWB)
     * [EN] Add an AWB for a specific order (https://github.com/celdotro/marketplace/wiki/AWB-Import)
     * @param $cmd
     * @param $awb
     * @param $idAdresaRidicare
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function importAWB($cmd, $awb, $idAdresaRidicare){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'importAWB';

        // Set data
        $data = array('orders_id' => $cmd, 'awb' => $awb, 'idAdresaRidicare' => $idAdresaRidicare);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Generare AWB (https://github.com/celdotro/marketplace/wiki/Generare-AWB)
     * [EN] Generate AWB (https://github.com/celdotro/marketplace/wiki/Generate-AWB)
     * @param $orders_id
     * @param $idAddress
     * @return mixed
     * @throws \Exception
     */
    public function generateAwb($orders_id, $idAddress){
        // Sanity check
        if(!isset($orders_id) || !is_int($orders_id)) throw new \Exception('Specificati comanda');
        if(!isset($idAddress) || !is_int($idAddress)) throw new \Exception('Specificati adresa');

        // Set method and action
        $method = 'orders';
        $action = 'generateAwb';

        // Set data
        $data = array('orders_id' => $orders_id, 'idAddress' => $idAddress);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}