<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersData {

    /**
     * Retrieve data associated with an order
     * @param $cmd
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function getOrderInfo($cmd){
        // Sanity check - for older versions of PHP
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('$cmd trebuie sa fie de tip integer');

        // Set method and action
        $method = 'orders';
        $action = 'getOrder';

        // Set data
        $data = array('order' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}