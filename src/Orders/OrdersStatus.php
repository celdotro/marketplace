<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersStatus {

    /**
     * [RO] Anuleaza o anumita comanda. Un motiv valid e necesar. (https://github.com/celdotro/marketplace/wiki/Anularea-comenzii)
     * [EN] Cancel a specific order. A valid reason is necessary. (https://github.com/celdotro/marketplace/wiki/Cancel-Order)
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

    /**
     * [RO] Confirma o comanda existenta (https://github.com/celdotro/marketplace/wiki/Confirmare-comanda)
     * [EN] Confirms an existing order (https://github.com/celdotro/marketplace/wiki/Confirm-order)
     * @param $cmd
     * @return mixed
     * @throws \Exception
     */
    public function confirmOrder($cmd){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'confirmOrder';

        // Set data
        $data = array('order' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}