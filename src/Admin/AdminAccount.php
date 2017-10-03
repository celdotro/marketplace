<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminAccount {

    /**
     * [RO] Actualizeaza urmatoarele date aferente afiliatului: CIF, IBAN, numar de telefon si parola (https://github.com/celdotro/marketplace/wiki/Actualizare-informatii-cont)
     * [EN] Updates the following data of an affiliate: CIF, IBAN, phone number, and password (https://github.com/celdotro/marketplace/wiki/Actualizare-informatii-cont)
     * @param null $cif
     * @param null $iban
     * @param null $telephone
     * @param null $password
     * @return mixed
     * @throws \Exception
     */
    public function updateAccountInformation ($cif = NULL, $iban = NULL, $telephone = NULL, $password = NULL) {
        // Sanity check - skip it because it needs additional methods and packages which will just bloat this project
        // All proper checks for data integrity are done on our server

        // Set method and action
        $method = 'admininfo';
        $action = 'updateAccountInformation';

        // Set data
        $data = array();
        if(!is_null($cif)) $data['cif'] = $cif;
        if(!is_null($iban)) $data['iban'] = $iban;
        if(!is_null($telephone)) $data['telephone'] = $telephone;
        if(!is_null($password)) $data['password'] = $password;

        if(empty($data)) throw new \Exception('Specificati cel putin 1 camp');

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia o lista cu informatii generale ale contului de afiliat (https://github.com/celdotro/marketplace/wiki/Listeaza-informatiile-contului)
     * [EN] Retrieves a list of general account information (https://github.com/celdotro/marketplace/wiki/List-account-information)
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