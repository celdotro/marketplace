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

    /**
     * [RO] Diferente de pret fata de site-uri externe (https://github.com/celdotro/marketplace/wiki/Diferenta-pret)
     * [EN] Price difference for external sites (https://github.com/celdotro/marketplace/wiki/Price-difference)
     * @return mixed
     * @throws \Exception
     */
    public function priceDiff(){
        $method = 'reports';
        $action = 'priceDiff';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }
}