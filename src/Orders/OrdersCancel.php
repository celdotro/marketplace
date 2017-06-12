<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersCancel {

    /**
     * [RO] Anuleaza o anumita comanda. Un motiv valid e necesar.
     * [EN] Cancel a specific order. A valid reason is necessary.
     * @param $cmd
     * @param $reason
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function cancelOrder($cmd, $reason){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($reason) || trim($reason) == '') throw new \Exception('Specificati un motiv pentru anualrea comenzii format din cel putin 1 caracter diferit de spatiu');

        // Set method and action
        $method = 'orders';
        $action = 'cancelOrder';

        // Set data
        $data = array('order' => $cmd, 'reason' => $reason);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}