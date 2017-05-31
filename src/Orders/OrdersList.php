<?php
namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersList {

    /**
     * List orders for a customer filtered by date.
     * List can be shrinked using a start position and a limit.
     * @param $start
     * @param $limit
     * @param $data
     * @param $sign
     * @param $customer
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listOrders($start, $limit, $options){
        // Sanity check
        if(!isset($start) || !is_int($start)) throw new Exception('$start trebuie sa fie de tip integer');
        if(!isset($limit) || !is_int($limit)) throw new Exception('$limit trebuie sa fie de tip integer');
        if(!isset($options) || !is_array($options)) throw new Exception('$options trebuie sa fie un array');

        // Set method and action
        $method = 'orders';
        $action = 'getOrders';

        // Set data
        $data = array(
            'start' =>  $start,
            'limit' =>  $limit,
            'options'  =>  $options,
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}