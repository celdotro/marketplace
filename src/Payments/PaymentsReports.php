<?php

namespace celmarket\Payments;

use celmarket\Dispatcher;

class PaymentsReports {

    /**
     * [RO] Preia informatii aferente platilor lunare cu cardul (https://github.com/celdotro/marketplace/wiki/Plati-cu-cardul)
     * [EN] Retrieve information about monthly card payments (https://github.com/celdotro/marketplace/wiki/Card-payments)
     * @param $month
     * @return mixed
     * @throws \Exception
     */
    public function getCardPayments($month){
        // Sanity check

        // Set method and action
        $method = 'commissions';
        $action = 'getCardOrdersByMonth';

        // Set data
        $data = array('month' => $month);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia lunile aferente platilor cu cardul (https://github.com/celdotro/marketplace/wiki/Preia-lunile-platilor-cu-cardul)
     * [EN] Retrieve card payment months (https://github.com/celdotro/marketplace/wiki/Retrieve-card-payments-months)
     * @return mixed
     * @throws \Exception
     */
    public function getCardPaymentMonths(){
        // Sanity check

        // Set method and action
        $method = 'commissions';
        $action = 'getCardPaymentMonths';

        // Set data
        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia lunile in care s-au generat borderouri (https://github.com/celdotro/marketplace/wiki/Preia-lunile-borderourilor)
     * [EN] Get months in which orders summary was generated (https://github.com/celdotro/marketplace/wiki/Get-summary-months)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSummaryMonths(){
        // Sanity check

        // Set method and action
        $method = 'commissions';
        $action = 'getMonths';

        // Set data
        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia comisioanele nefacturate (https://github.com/celdotro/marketplace/wiki/Preia-comisioanele-nefacturate)
     * [EN] Get unbilled commissions (https://github.com/celdotro/marketplace/wiki/Get-unbilled-commissions)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUnbilledCommissions(){
        // Sanity check

        // Set method and action
        $method = 'commissions';
        $action = 'getComosioaneNefacturate';

        // Set data
        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia comisioanele facturate (https://github.com/celdotro/marketplace/wiki/Preia-comisioane-facturate)
     * [EN] Retrieve billed commissions (https://github.com/celdotro/marketplace/wiki/Retrieve-billed-commissions)
     * @param $month
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBilledCommissions($month){
        // Sanity check
        if(empty($month)) throw new \Exception('Nu ati specificat luna');

        // Set method and action
        $method = 'commissions';
        $action = 'getComisioaneFacturate';

        // Set data
        $data = array('month' => $month);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Aproba comanda (https://github.com/celdotro/marketplace/wiki/Aproba-comanda)
     * [EN] Approve order (https://github.com/celdotro/marketplace/wiki/Approve-order)
     * @param $oid
     * @param $borderou
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function approveOrder($oid, $borderou){
        // Sanity check
        if(empty($oid)) throw new \Exception('Nu ati specificat id-ul comenzii');
        if(empty($borderou)) throw new \Exception('Nu ati specificat borderoul');

        // Set method and action
        $method = 'commissions';
        $action = 'approveOrder';

        // Set data
        $data = array(
            'oid' => $oid,
            'borderou' => $borderou
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Respinge comanda (https://github.com/celdotro/marketplace/wiki/Respinge-comanda)
     * [EN] Reject order (https://github.com/celdotro/marketplace/wiki/Reject-order)
     * @param $oid
     * @param $borderou
     * @param $reason
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function rejectOrder($oid, $borderou, $reason){
        // Sanity check
        if(empty($oid)) throw new \Exception('Nu ati specificat id-ul comenzii');
        if(empty($borderou)) throw new \Exception('Nu ati specificat borderoul');
        if(empty($reason)) throw new \Exception('Nu ati specificat problema');

        // Set method and action
        $method = 'commissions';
        $action = 'rejectOrder';

        // Set data
        $data = array(
            'oid' => $oid,
            'borderou' => $borderou,
            'reason' => $reason
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Genereaza factura (https://github.com/celdotro/marketplace/wiki/Genereaza-factura)
     * [EN] Generate invoice (https://github.com/celdotro/marketplace/wiki/Generate-invoice)
     * @param $borderou
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generateInvoice($borderou){
        // Sanity check
        if(empty($borderou)) throw new \Exception('Nu ati specificat borderoul');

        // Set method and action
        $method = 'commissions';
        $action = 'generateInvoice';

        // Set data
        $data = array(
            'borderou' => $borderou,
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Descarca factura (https://github.com/celdotro/marketplace/wiki/Descarca-factura)
     * [EN] Download invoice (https://github.com/celdotro/marketplace/wiki/Download-invoice)
     * @param $borderou
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function downloadInvoice($borderou){
        // Sanity check
        if(empty($borderou)) throw new \Exception('Nu ati specificat borderoul');

        // Set method and action
        $method = 'commissions';
        $action = 'downloadInvoice';

        // Set data
        $data = array(
            'borderou' => $borderou,
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}