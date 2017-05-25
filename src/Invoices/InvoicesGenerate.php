<?php

namespace celmarket\Invoices;

use celmarket\Dispatcher;

class InvoicesGenerate {

    public function generateInvoiceDisp($cmd){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'GenerateInvoiceDisp';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}