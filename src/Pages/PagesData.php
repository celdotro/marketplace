<?php

namespace celmarket\Pages;

use celmarket\Dispatcher;

class PagesData {

    /**
     * [RO] Returneaza toate paginile (https://github.com/celdotro/marketplace/wiki/Listare-Pagini)
     * [EN] Get all pages (https://github.com/celdotro/marketplace/wiki/List-pages)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPages(){
        // Set method and action
        $method = 'settings';
        $action = 'getPages';

        // Set data
        $data = array(array(1)); // At least one parameter is required by API

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}