<?php

namespace celmarket\Invoices;

use celmarket\Dispatcher;

class InvoicesData {

    public function setInvoiceData($cmd, $serie, $nr){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(empty($serie)) throw new \Exception('Specificati seria');
        if(empty($nr)) throw new \Exception('Specificati numarul');

        // Set method and action
        $method = 'orders';
        $action = 'setInvoiceData';

        // Set data
        $data = array(
            'orders_id' => $cmd,
            'serie' => $serie,
            'nr' => $nr
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function removeInvoice($ordersID){
        // Sanity check
        if(!isset($ordersID) || !is_int($ordersID)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'removeInvoice';

        // Set data
        $data = array('orders_id' => $ordersID);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}