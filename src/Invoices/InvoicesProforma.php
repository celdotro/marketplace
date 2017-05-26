<?php


namespace celmarket\Invoices;


class InvoicesProforma {

    /**
     * Retrieve invoice proforma
     * @param $cmd
     * @return mixed
     * @throws \Exception
     */
    public function getProforma($cmd){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'GetProforma';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}