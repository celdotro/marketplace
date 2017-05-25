<?php

namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsData {

    public function getProductData($modelType, $categoryID){
        // Sanity check - for older versions of PHP
        if (!isset($modelType) || !is_int($modelType) || $modelType != 0 && $modelType != 1) throw new \Exception('$modelType trebuie sa fie 0 sau 1');
        if ($modelType == 0 && !isset($categoryID)) throw new \Exception('Pentru $modelType = 0, trebuie sa specificati categoria');

        // Set method and action
        $method = 'products';
        $action = 'GetProductData';

        // Set data
        $data['modelType'] = $modelType;
        if(isset($categoryID)) $data['categoryID'] = $categoryID;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}