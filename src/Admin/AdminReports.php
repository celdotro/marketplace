<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminReports {

    public function getBillableProducts(){
        // Set method and action
        $method = 'admininfo';
        $action = 'GetBillableProducts';

        // Set data
        $data = array('param' => 1);

        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Factureaza produsele disponibile (https://github.com/celdotro/marketplace/wiki/Factureaza-produse)
     * [EN] Bills available products (https://github.com/celdotro/marketplace/wiki/Bill-products)
     * @param $products
     * @return mixed
     */
    public function billProducts($products){
        // Set method and action
        $method = 'admininfo';
        $action = 'BillProducts';

        // Set data
        $data = array('products' => $products);

        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function getServiceRequests($type, $page = 1){
        // Set method and action
        $method = 'admininfo';
        $action = 'GetServiceRequests';

        // Set data
        $data = array('type' => $type, 'page' => $page);

        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}