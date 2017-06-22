<?php

namespace celmarket\Invoices;

use celmarket\Dispatcher;

class InvoicesGenerate {

    /**
     * [RO] Genereaza factura pentru o anumita comanda (https://github.com/celdotro/marketplace/wiki/Generare-factura)
     * [EN] Generate the invoice of a specific order (https://github.com/celdotro/marketplace/wiki/Generate-invoice)
     * @param $cmd
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function generateInvoice($cmd){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'generateInvoice';

        // Set data
        $data = array('order' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}