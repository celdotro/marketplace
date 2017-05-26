<?php

namespace celmarket\Invoices;

use celmarket\Dispatcher;

class InvoicesPrint {

    /**
     * Print the invoice of a specific order. If $check is false, it won't check product stocks.
     * @param $cmd
     * @param $skipCheck
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function printInvoice($cmd, $check){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($check)) $check = true;
        if(!is_bool($check)) throw new \Exception('$skipCheck este boolean');
        $check = !$check;

        // Set method and action
        $method = 'orders';
        $action = 'printInvoice';

        // Set data
        $data = array('order' => $cmd, 'check' => $check);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return base64_decode($result);
    }

}