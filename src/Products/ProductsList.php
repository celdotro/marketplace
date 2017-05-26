<?php

namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsList
{
    /**
     * Get all categories
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCategories()
    {
        // Set method and action
        $method = 'import';
        $action = 'getSupplierCategories';

        // Set data
        $data = array();

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function listProducts($start, $limit, $search = null){
        // Sanity check
        if(!isset($start) || !is_int($start) || $start < 0) throw new \Exception('Precizati o valoare de start numar natural');
        if(!isset($limit) || !is_int($limit) || $limit < 0) throw new \Exception('Precizati un numar natural pentru limita');

        // Set method and action
        $method = 'products';
        $action = 'readProducts';

        // Set data
        $data = array('start' => $start, 'limit' => $limit);
        if(!is_null($search)) $data['search'] = $search;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}
