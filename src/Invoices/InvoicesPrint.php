<?php

namespace celmarket\Invoices;

use celmarket\Dispatcher;

class InvoicesPrint {

    public function printInvoice($cmd, $skipCheck){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($skipCheck)) $skipCheck = false;
        if(!is_bool($skipCheck)) throw new \Exception('$skipCheck este boolean');

        // Set method and action
        $method = 'orders';
        $action = 'PrintInvoice';

        // Set data
        $data = array('cmd' => $cmd, 'skip_check' => $skipCheck);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}