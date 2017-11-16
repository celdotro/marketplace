<?php

namespace celmarket\Invoices;

use celmarket\Dispatcher;

class InvoicesData {

    /**
     * [RO] Genereaza o noua factura (https://github.com/celdotro/marketplace/wiki/Adaugare-factura)
     * [EN] Generates a new invoice (https://github.com/celdotro/marketplace/wiki/Add-invoice)
     * @param $cmd
     * @param $serie
     * @param $nr
     * @return mixed
     * @throws \Exception
     */
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

    /**
     * [RO] Sterge factura unei facturi (https://github.com/celdotro/marketplace/wiki/Stergere-factura)
     * [EN] Deletes an order's invoice (https://github.com/celdotro/marketplace/wiki/Remove-Invoice)
     * @param $ordersID
     * @return mixed
     * @throws \Exception
     */
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