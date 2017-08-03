<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersAWBInfo {

    /**
     * [RO] Seteaza informatiile necesare AWB-ului unei anumite comenzi (https://github.com/celdotro/marketplace/wiki/Setare-date-AWB)
     * [EN] Set the AWB information for a specific order (https://github.com/celdotro/marketplace/wiki/Set-AWB-Info)
     *
     * @param $cmd
     * @param $courier
     * @param $idAdresaRidicare
     * @param null $plic
     * @param null $packages
     * @param null $kg
     * @param int $sambata
     * @return mixed
     * @throws \Exception
     */
    public function setAwbInfo($cmd, $courier, $idAdresaRidicare, $plic = null, $packages = null, $kg = null, $sambata = 0){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($courier) || trim($courier) == '') throw new \Exception('Specificati curierul');
        if(!isset($plic) || !is_int($plic) || $plic < 1){
            if(
                (!isset($packages) || !is_int($packages) || $packages < 1)
                && (!isset($kg) || !is_int($kg) || $kg < 0)
            ){
                throw new \Exception('Specificati daca este plic sau daca nu, atunci trimiteti numarul de pachete si kg');
            }
        }
        if(!isset($idAdresaRidicare) || !is_numeric($idAdresaRidicare)) throw new \Exception('Specificati o adresa de ridicare valida');

        // Set method and action
        $method = 'orders';
        $action = 'setAwbInfo';

        // Set data
        $data = array('cmd' => $cmd, 'courier' => $courier);
        if(isset($plic)) $data['plic'] = $plic;
        if(isset($packages)) {
            $data['packages'] = $packages;
            $data['kg'] = $kg;
        }
        $data['sambata'] = $sambata;
        $data['idAdresaRidicare'] = $idAdresaRidicare;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}