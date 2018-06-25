<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminHistory {

    /**
     * [RO] Returneaza date despre istoricul importurilor (https://github.com/celdotro/marketplace/wiki/Istoric-importuri)
     * [EN] Returns data about import history (https://github.com/celdotro/marketplace/wiki/Import-history)
     * @param null $date_start
     * @param null $date_stop
     * @param null $import_type
     * @param int $page
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getImportHistory ($date_start = null, $date_stop = null, $import_type = NULL, $page = 0) {
        // Set method and action
        $method = 'admininfo';
        $action = 'getImportHistory';

        $data = array();

        // Set data
        if (!is_null($date_start)) $data['data_start'] = $date_start;
        if (!is_null($date_stop)) $data['data_stop'] = $date_stop;
        if (!is_null($import_type)) $data['tip_import'] = $import_type;
        if (!is_null($page) && $page != 0) $data['page'] = $page;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}