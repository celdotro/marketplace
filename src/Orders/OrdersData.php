<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersData {

    /**
     * [RO] Preia datele asociate cu o anumita comanda (https://github.com/celdotro/marketplace/wiki/Datele-comenzii)
     * [EN] Retrieve data associated with an order (https://github.com/celdotro/marketplace/wiki/Order-data)
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