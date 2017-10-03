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

}