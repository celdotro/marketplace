<?php

namespace celmarket\Pages;

use celmarket\Dispatcher;

class PagesDelete {

    /**
     * [RO] Sterge paginile pe baza ID-ului (https://github.com/celdotro/marketplace/wiki/Stergere-pagini)
     * [EN] Delete page based on ID (https://github.com/celdotro/marketplace/wiki/Remove-page)
     * @param $pageID
     * @return mixed
     * @throws \Exception
     */
    public function deletePage($pageID){
        // Sanity check
        if(!isset($pageID) || !is_int($pageID)) throw new \Exception('ID-ul trebuie sa fie un numar intreg');

        // Set method and action
        $method = 'settings';
        $action = 'deletePage';

        // Set data
        $data = array('id' => $pageID);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}