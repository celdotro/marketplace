<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class Payments {

    /**
     * [RO] Returneaza date despre platile efectuate catre afiliat pentru fiecare factura (https://github.com/celdotro/marketplace/wiki/Date-plati-facturi)
     * [EN] Returns data about the payments done in an affiliate's account for each invoice (https://github.com/celdotro/marketplace/wiki/Invoices-payment-data)
     * @param $paymentStatus
     * @param null $numInvoice
     * @param null $startDate_inv
     * @param null $endDate_inv
     * @param null $numOrder
     * @param null $startDate_order
     * @param null $endDate_order
     * @param null $page
     * @throws \Exception
     */
    public function getInvoicesData($paymentStatus, $numInvoice = NULL, $startDate_inv = NULL, $endDate_inv = NULL, $numOrder = NULL, $startDate_order = NULL, $endDate_order = NULL, $page = NULL){
        // Sanity check
        if (is_null($paymentStatus) || !in_array($paymentStatus, array(1,2,3))) throw new \Exception('Specificati un status valid al platilor');

        // Set method and action
        $method = 'admininfo';
        $action = 'getInvoicesData';

        // Set data
        $data = array('paymentStatus' => $paymentStatus);

        if(!is_null($numInvoice)) $data['nrFact'] = $numInvoice;
        if(!is_null($startDate_inv)) $data['startDate_fact'] = $startDate_inv;
        if(!is_null($endDate_inv)) $data['endDate_fact'] = $endDate_inv;

        if(!is_null($numOrder)) $data['nrCmd'] = $numOrder;
        if(!is_null($startDate_order)) $data['startDate_cmd'] = $startDate_order;
        if(!is_null($endDate_order)) $data['endDate_cmd'] = $endDate_order;

        if(!is_null($page)) $data['page'] = $page;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * Returns an invoice's payments and other relevant data
     * @param $numInvoice
     * @param $numOrder
     * @throws \Exception
     */
    public function showPayments($numInvoice, $numOrder){
        // Sanity check
        if (is_null($numInvoice)) throw new \Exception ('Specificati numarul facturii');
        if (is_null($numOrder)) throw new \Exception ('Specificati numarul comenzii');

        // Set// Set method and action
        $method = 'admininfo';
        $action = 'showPayments';

        // Set data
        $data = array(
            'numInvoice' => $numInvoice,
            'numOrder' => $numOrder
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}