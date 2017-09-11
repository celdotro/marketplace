<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersUpdate {

    /**
     * [RO] Actualizeaza produsele pentru o comanda (https://github.com/celdotro/marketplace/wiki/Actualizare-comenzi)
     * [EN] Update the products of an order (https://github.com/celdotro/marketplace/wiki/Update-orders)
     * @param $cmd
     * @param $arrProducts
     * @return mixed
     * @throws \Exception
     */
    public function updateProductsFromOrder($cmd, $arrProducts){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($arrProducts) || !is_array($arrProducts) || empty($arrProducts)) throw new \Exception('$arrProducts trebuie sa fie un array care sa contina un alt array cu datele produselor pe care doriti sa le actualizati in comanda');

        // Set method and action
        $method = 'orders';
        $action = 'saveOrderData';

        // Set data
        $data = array('order' => $cmd, 'data' => json_encode($arrProducts));

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Adauga noi produse intr-o comanda existenta (https://github.com/celdotro/marketplace/wiki/Adaugarea-de-noi-produse-in-comanda)
     * [EN] Add new products to an existing order (https://github.com/celdotro/marketplace/wiki/Adaugarea-de-noi-produse-in-comanda)
     * @param $cmd
     * @param $arrProducts
     * @return mixed
     * @throws \Exception
     */
    public function addProductsToOrder($cmd, $arrProducts){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($arrProducts) || !is_array($arrProducts) || empty($arrProducts)) throw new \Exception('$arrProducts trebuie sa fie un array care sa contina un alt array cu datele produselor pe care doriti sa le actualizati in comanda');

        // Set method and action
        $method = 'orders';
        $action = 'addProductsToOrder';

        // Set data
        $data = array('order' => $cmd, 'data' => json_encode($arrProducts));

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Sterge un produs dintr-o comanda existenta (https://github.com/celdotro/marketplace/wiki/Stergerea-unui-model-de-produs-din-comanda)
     * [EN] Remove a product model from an existing order (https://github.com/celdotro/marketplace/wiki/Remove-product-model-from-order)
     * @param $cmd
     * @param $arrProducts
     * @return mixed
     * @throws \Exception
     */
    public function removeProductsFromOrder($cmd, $arrProducts){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($arrProducts) || !is_array($arrProducts) || empty($arrProducts)) throw new \Exception('$arrProducts trebuie sa fie un array care sa contina un alt array cu datele produselor pe care doriti sa le actualizati in comanda');

        // Set method and action
        $method = 'orders';
        $action = 'removeProductsFromOrder';

        // Set data
        $data = array('order' => $cmd, 'data' => json_encode($arrProducts));

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}