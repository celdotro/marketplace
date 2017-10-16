<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminAccount {

    /**
     * [RO] Actualizeaza urmatoarele date aferente afiliatului: CIF, IBAN si numar de telefon (https://github.com/celdotro/marketplace/wiki/Actualizare-informatii-cont)
     * [EN] Updates the following data of an affiliate: CIF, IBAN, and phone number (https://github.com/celdotro/marketplace/wiki/Actualizare-informatii-cont)
     * @param null $cif
     * @param null $iban
     * @param null $telephone
     * @return mixed
     * @throws \Exception
     */
    public function updateAccountInformation ($cif = NULL, $iban = NULL, $telephone = NULL, $password = NULL, $bankName = NULL, $fullName = NULL, $hqAddress = NULL, $description = NULL) {
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
        if(!is_null($bankName)) $data['bankName'] = $bankName;
        if(!is_null($fullName)) $data['fullName'] = $fullName;
        if(!is_null($hqAddress)) $data['hqAddress'] = $hqAddress;
        if(!is_null($description)) $data['description'] = $description;

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