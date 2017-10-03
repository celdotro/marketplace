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

}