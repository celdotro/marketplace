<?php

namespace celmarket\Pages;

use celmarket\Dispatcher;

class PagesImport {

    /**
     * [RO] Salveaza datele paginii
     * [EN] Save page data
     * @param $pageID
     * @param $pageData
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function savePage($pageID, $pageData){
        // Sanity check
        if(!isset($pageID) || !is_int($pageID)) throw new Exception('Specificati un ID al paginii');
        if(!isset($pageData) || !is_array($pageData) || empty($pageData)) throw new Exception('$pages trebuie sa contina un array cu datele paginii');

        // Set method and action
        $method = 'settings';
        $action = 'savePage';

        // Set data
        $data = array('id' => $pageID, 'data' => $pageData);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}