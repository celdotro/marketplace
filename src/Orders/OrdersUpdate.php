<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersUpdate {

    public function setProductPrice($cmd, $model, $newPrice){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($model) || trim($model) === '') throw new \Exception('Specificati modelul');
        if(!isset($newPrice) || !is_numeric($newPrice)) throw new \Exception('Specificati un pret valid');

        // Set method and action
        $method = 'orders';
        $action = 'SetProductPrice';

        // Set data
        $data = array('cmd' => $cmd, 'model' => $model, 'new_price' => $newPrice);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function addProductsToOrder($cmd, $arrModels){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($arrModels) || !is_array($arrModels) || empty($arrModels)) throw new \Exception('$arrModels trebuie sa fie un array care sa contina modelele produselor ce vor fi adaugate in comanda');

        // Set method and action
        $method = 'orders';
        $action = 'AddProductsToOrder';

        // Set data
        $data = array('cmd' => $cmd, 'products' => $arrModels);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function removeProductsFromOrder($cmd, $arrModels){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($arrModels) || !is_array($arrModels) || empty($arrModels)) throw new \Exception('$arrModels trebuie sa fie un array care sa contina modelele produselor ce vor fi eliminate din comanda');

        // Set method and action
        $method = 'orders';
        $action = 'RemoveProductsFromOrder';

        // Set data
        $data = array('cmd' => $cmd, 'products' => $arrModels);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function updateProductsFromOrder($cmd, $arrProducts){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($arrProducts) || !is_array($arrProducts) || empty($arrProducts)) throw new \Exception('$arrProducts trebuie sa fie un array care sa contina un alt array cu datele produselor pe care doriti sa le actualizati in comanda');

        // Set method and action
        $method = 'orders';
        $action = 'UpdateProductsFromOrder';

        // Set data
        $data = array('cmd' => $cmd, 'products' => $arrProducts);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}