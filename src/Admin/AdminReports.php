<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminReports {

    /**
     * [RO] Listeaza produsele facturabile (https://github.com/celdotro/marketplace/wiki/Listeaza-produsele-facturabile)
     * [EN] List all products that can be billed (https://github.com/celdotro/marketplace/wiki/List-billable-products)
     * @return mixed
     */
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

    /**
     * [RO] Preia cererile de service sau retur ale clientilor (https://github.com/celdotro/marketplace/wiki/Preia-cererile-de-service)
     * [EN] Retrieve service or return requests (https://github.com/celdotro/marketplace/wiki/Retrieve-service-requests)
     * @param $type
     * @param int $page
     * @return mixed
     */
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