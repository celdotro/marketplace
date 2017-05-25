<?php
namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersSummary {

    public function getSummary($nrDays = 0){
        // Sanity check
        if(!isset($nrDays) || !is_int($nrDays)) throw new Exception('$nrDays trebuie sa fie de tip integer');

        // Set method and action
        $method = 'home';
        $action = 'OrdersSummary';

        // Set data
        $data = array('nrDays' => $nrDays);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}