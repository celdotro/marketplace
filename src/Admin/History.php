<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class History {

    /**
     * [RO] Returneaza date despre istoricul importurilor (https://github.com/celdotro/marketplace/wiki/Istoric-importuri)
     * [EN] Returns data about import history (https://github.com/celdotro/marketplace/wiki/Import-history)
     * @param $date_start
     * @param $date_stop
     * @param null $import_type
     * @param int $page
     * @throws \Exception
     */
    public function getImportHistory ($date_start, $date_stop, $import_type = NULL, $page = 0) {
        // Sanity check
        if (!isset($date_start) || strtotime($date_start) == false) throw new \Exception('Specificati data de inceput a importului');
        if (!isset($date_stop) || strtotime($date_stop) == false) throw new \Exception('Specificati data de sfarsit a importului');

        // Set method and action
        $method = 'admininfo';
        $action = 'getImportHistory';

        // Set data
        $data = array('data_start' => $date_start, 'data_stop' => $date_stop);
        if (!is_null($import_type)) $data['tip_import'] = $import_type;
        if (!is_null($page) && $page != 0) $data['page'] = $page;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}