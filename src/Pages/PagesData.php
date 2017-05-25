<?php

namespace celmarket\Pages;

use celmarket\Dispatcher;

class PagesData {

    public function getPages(){
        // Set method and action
        $method = 'home';
        $action = 'GetPages';

        // Set data
        $data = array(array(1)); // At least one parameter is required by API

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}