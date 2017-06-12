<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersUpdate {

    /**
     * [RO] Actualizeaza produsele pentru o comanda
     * [EN] Update the products of an order
     * @param $cmd
     * @param $arrProducts
     * @return \Psr\Http\Message\ResponseInterface
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

}