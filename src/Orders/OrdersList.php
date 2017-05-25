<?php
namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersList {

    public function listOrders($start, $limit, $data, $sign, $customer){
        // Sanity check
        if(!isset($start) || !is_int($start)) throw new Exception('$start trebuie sa fie de tip integer');
        if(!isset($limit) || !is_int($limit)) throw new Exception('$limit trebuie sa fie de tip integer');
        if(!isset($data) || strtotime($data) === false) throw new Exception('$data trebuie sa fie de tip data calendaristica');
        if(!isset($sign) || !in_array($sign, array('gt', 'st', 'ge', 'se', 'ee'))) throw new Exception('$sign trebuie sa aiba una dintre urmatoarele valori: gt, st, ge, se, ee');
        if(!isset($customer) || trim($customer) == '') throw new Exception('$customer trebuie sa contina cel putin 1 caracter diferit de spatiu');

        // Set method and action
        $method = 'orders';
        $action = 'ListOrders';

        // Set data
        $data = array(
            'start' =>  $start,
            'limit' =>  $limit,
            'data'  =>  $data,
            'sign'  =>  $sign,
            'customer'  =>  $customer
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}