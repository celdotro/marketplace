<?php

namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsBonus {

    /**
     * [RO] Adauga bonusul pentru un produs (https://github.com/celdotro/marketplace/wiki/Adauga-bonus)
     * [EN] Adds bonuses for a product (https://github.com/celdotro/marketplace/wiki/Add-bonus)
     * @param $model
     * @param array $bonus
     * @return mixed
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
     * [RO] Listeaza bonusurile unui produs (https://github.com/celdotro/marketplace/wiki/Listeaza-bonus)
     * [EN] Get a product's bonuses (https://github.com/celdotro/marketplace/wiki/List-bonus)
     * @param $model
     * @return mixed
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
     * [RO] Sterge bonusurile unui produs (https://github.com/celdotro/marketplace/wiki/Stergere-bonus)
     * [EN] Deletes a product's bonuses (https://github.com/celdotro/marketplace/wiki/Delete-bonus)
     * @param $model
     * @param array $bonus
     * @return mixed
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