<?php

namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsList
{

    public function getCategories($limit){
        // Sanity check - for older versions of PHP
        if(!isset($limit) || !is_int($limit)) throw new \Exception('$limit trebuie sa fie de tip integer');

        // Set method and action
        $method = 'home';
        $action = 'GetCategories';

        // Set data
        $data = array('limit' => $limit);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}
