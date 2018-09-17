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

}