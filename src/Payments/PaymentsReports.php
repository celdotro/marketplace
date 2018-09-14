<?php

namespace celmarket\Payments;

use celmarket\Dispatcher;

class PaymentsReports {

    /**
     * [RO] Preia informatii aferente platilor lunare cu cardul
     * [EN] Retrieve information about monthly card payments
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

}