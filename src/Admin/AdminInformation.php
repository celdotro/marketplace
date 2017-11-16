<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminInformation {

    public function getTransportTax($id = null){
        // Set method and action
        $method = 'admininfo';
        $action = 'getTransportTax';

        // Set data
        if(!is_null($id)) $data = array('id' => $id);
        else $data = array();

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function updateTransportTax($id, $newValue = null, $newLimit = null){
        // Sanity check
        if(is_null($newValue) && is_null($newLimit)) throw new \Exception('Limita sau valoarea trebuie sa fie nenule');
        // Set method and action
        $method = 'admininfo';
        $action = 'updateTransportTax';

        // Set data
        $data = array('id' => $id);
        if(!is_null($newValue)) $data['newValue'] = $newValue;
        if(!is_null($newLimit)) $data['newLimit'] = $newLimit;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function insertTaxForAllCategories($newValue = null, $newLimit = null){
        // Sanity check
        if(is_null($newValue) && is_null($newLimit)) throw new \Exception('Limita sau valoarea trebuie sa fie nenule');
        // Set method and action
        $method = 'admininfo';
        $action = 'insertTaxForAllCategories';

        // Set data
        if(!is_null($newValue)) $data['newValue'] = $newValue;
        if(!is_null($newLimit)) $data['newLimit'] = $newLimit;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}