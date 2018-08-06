<?php

namespace celmarket\Reports;

use celmarket\Dispatcher;

class FinancialReports {
    /**
     * [RO] Preia datele agregate lunar ale platilor cu cardul (https://github.com/celdotro/marketplace/wiki/Plati-cu-cardul)
     * [EN] Retrieves aggregate monthly reports of card payments (https://github.com/celdotro/marketplace/wiki/Card-payments)
     * @param $dateMin
     * @param $dateMax
     * @return mixed
     * @throws \Exception
     */
    public function cardPayments($dateMin, $dateMax){
        $method = 'reports';
        $action = 'cardPayments';

        // Set data
        $data = array(
            'dateMin' => $dateMin,
            'dateMax' => $dateMax,
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}