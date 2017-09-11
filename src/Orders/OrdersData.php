<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersData {

    /**
     * [RO] Preia datele asociate cu o anumita comanda (https://github.com/celdotro/marketplace/wiki/Datele-comenzii)
     * [EN] Retrieve data associated with an order (https://github.com/celdotro/marketplace/wiki/Order-data)
     * @param $cmd
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function getOrderInfo($cmd){
        // Sanity check - for older versions of PHP
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati un ID valid al comenzii');

        // Set method and action
        $method = 'orders';
        $action = 'getOrder';

        // Set data
        $data = array('order' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Verifica daca pentru o anumita comanda a fost efectuata plata (https://github.com/celdotro/marketplace/wiki/Verifica-plata-pentru-comanda)
     * [EN] Checks if the payment was made for a specific order (https://github.com/celdotro/marketplace/wiki/Check-payment-for-order)
     * @param $cmd
     * @return mixed
     * @throws \Exception
     */
    public function checkPaymentForOrder($cmd){
        // Sanity check - for older versions of PHP
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati un ID valid al comenzii');

        // Set method and action
        $method = 'orders';
        $action = 'checkPaymentForOrder';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}