<?php

namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsBonus {

    /**
     * Adds bonuses for a product
     * @param $model
     * @param array $bonus
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function addBonus($model, $bonus = array()){
        // Sanity check
        if(!isset($model) || trim($model) === '') throw new \Exception('Specificati modelul');
        if(!isset($bonus) || !is_array($bonus)) throw new \Exception('$bonus trebuie sa fie un array cu bonusuri');

        // Set method and action
        $method = 'products';
        $action = 'addBonus';

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
        $action = 'getBonus';

        // Set data
        $data = array('model' => $model);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * Deletes a products bonuses
     * @param $model
     * @param array $bonus
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function deleteBonus($model, $bonus = array()){
        // Sanity check
        if(!isset($model) || trim($model) === '') throw new \Exception('Specificati modelul');
        if(!isset($bonus) || !is_array($bonus)) throw new \Exception('$bonus trebuie sa fie un array cu bonusuri');

        // Set method and action
        $method = 'products';
        $action = 'deleteBonus';

        // Set data
        $data = array('model' => $model, 'bonus' => $bonus);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}