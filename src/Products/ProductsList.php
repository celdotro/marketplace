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

}
