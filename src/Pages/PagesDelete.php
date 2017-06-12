<?php

namespace celmarket\Pages;

use celmarket\Dispatcher;

class PagesDelete {

    /**
     * [RO] Sterge paginile pe baza ID-ului
     * [EN] Delete page based on ID
     * @param $pageID
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deletePage($pageID){
        // Sanity check
        if(!isset($pageID) || !is_int($pageID)) throw new Exception('ID-ul trebuie sa fie un numar intreg');

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