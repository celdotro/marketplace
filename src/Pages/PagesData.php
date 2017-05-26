<?php

namespace celmarket\Pages;

use celmarket\Dispatcher;

class PagesData {

    /**
     * Get all pages
     * @return \Psr\Http\Message\ResponseInterface
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