<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminAccount {

    /**
     * @param null $cif
     * @param null $iban
     * @param null $telephone
     * @return mixed
     * @throws \Exception
     */
    public function updateAccountInformation ($cif = NULL, $iban = NULL, $telephone = NULL) {
        // Sanity check

        // Set method and action
        $method = 'admininfo';
        $action = 'updateAccountInformation';

        // Set data
        $data = array();
        if(!is_null($cif)) $data['cif'] = $cif;
        if(!is_null($iban)) $data['iban'] = $iban;
        if(!is_null($telephone)) $data['telephone'] = $telephone;

        if(empty($data)) throw new \Exception('Specificati cel putin 1 camp');

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * @return mixed
     */
    public function getAccountInformation(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getAccountInformation';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }
}