<?php
namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersSummary {

    /**
     * [RO] Returneaza un sumar pentru ultimele zile.
     * [EN] Get orders summary for the last days.
     * @param int $nrDays
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getSummary($nrDays = 0){
        // Sanity check
        if(!isset($nrDays) || !is_int($nrDays)) throw new Exception('$nrDays trebuie sa fie de tip integer');

        // Set method and action
        $method = 'home';
        $action = 'getOrders';

        // Set data
        $data = array('nrDays' => $nrDays);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}