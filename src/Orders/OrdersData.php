<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersData {

    public function getOrderInfo($cmd){
        // Sanity check - for older versions of PHP
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('$cmd trebuie sa fie de tip integer');

        // Set method and action
        $method = 'orders';
        $action = 'GetOrderInfo';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}