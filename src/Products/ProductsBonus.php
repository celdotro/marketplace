<?php

namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsBonus {

    /**
     * Set bonuses for a product
     * @param $model
     * @param array $bonus
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function setBonus($model, $bonus = array()){
        // Sanity check
        if(!isset($model) || trim($model) === '') throw new \Exception('Specificati modelul');
        if(!isset($bonus) || !is_array($bonus)) throw new \Exception('$bonus trebuie sa fie un array cu bonusuri');

        // Set method and action
        $method = 'products';
        $action = 'SetBonus';

        // Set data
        $data = array('model' => $model, 'bonus' => $bonus);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * Get a products bonuses
     * @param $model
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function getBonus($model){
        // Sanity check
        if(!isset($model) || trim($model) === '') throw new \Exception('Specificati modelul');

        // Set method and action
        $method = 'products';
        $action = 'GetBonus';

        // Set data
        $data = array('model' => $model);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}