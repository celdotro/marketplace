<?php

namespace celmarket\Invoices;

use celmarket\Dispatcher;

class InvoicesData {

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


//    /**
//     * [RO] Genereaza o noua factura (https://github.com/celdotro/marketplace/wiki/Adaugare-factura)
//     * [EN] Generates a new invoice (https://github.com/celdotro/marketplace/wiki/Add-invoice)
//     * @param $cmd
//     * @param $serie
//     * @param $nr_fact
//     * @return mixed
//     * @throws \Exception
//     */
//    public function importInvoice($cmd, $serie, $nr_fact){
//      // Sanity check
//      if(empty($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
//      if(empty($serie)) throw new \Exception('Specificati seria facturii');
//      if(empty($nr_fact)) throw new \Exception('Specificati numarul  facturii');
//
//      // Set method and action
//      $method = 'orders';
//      $action = 'importInvoice';
//
//      // Set data
//      $data = array('order' => $cmd, 'data' => json_encode($arrProducts));
//
//      // Send request and retrieve response
//      $result = Dispatcher::send($method, $action, $data);
//
//      return $result;
//    }

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

}