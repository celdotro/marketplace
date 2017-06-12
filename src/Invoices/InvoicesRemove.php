<?php

namespace celmarket\Invoices;

use celmarket\Dispatcher;

class InvoicesRemove {

    /**
     * [RO] Elimina factura unei comenzi
     * [EN] Removes an order's invoice
     * @param $cmd
     * @throws \Exception
     */
    public function removeInvoice($cmd){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'billingDelete';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}