<?php

namespace celmarket\Invoices;

use celmarket\Dispatcher;

class InvoicesPrint {

    /**
     * [RO] Printeaza factura unei anumite comenzi. Daca parametrul $check este false, nu va verifica stocul produsului.
     * [EN] Print the invoice of a specific order. If the $check parameter is false, it won't check product stocks.
     * @param $cmd
     * @return bool|string
     * @throws \Exception
     */
    public function printInvoice($cmd){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'printInvoice';

        // Set data
        $data = array('order' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return base64_decode($result);
    }

}