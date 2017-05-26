<?php

namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsData {

    /**
     * Retrieve a category's data.
     * $modelType = 0 => basic data
     * $modelType = 1 => full data
     * @param $modelType
     * @param $categoryID
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function getCategoryData($modelType, $categoryID){
        // Sanity check - for older versions of PHP
        if (!isset($modelType) || !is_int($modelType) || $modelType != 0 && $modelType != 1) throw new \Exception('$modelType trebuie sa fie 0 sau 1');
        if ($modelType == 0 && !isset($categoryID)) throw new \Exception('Pentru $modelType = 0, trebuie sa specificati categoria');

        // Set method and action
        $method = 'example';
        if($modelType == 1) $action = 'getFastExample';
        else $action = 'getFullExample';

        // Set data
        if(isset($categoryID)) $data['cat_id'] = $categoryID;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}