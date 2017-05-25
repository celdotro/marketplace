<?php

namespace celmarket\Pages;

use celmarket\Dispatcher;

class PagesImport {

    public function savePages($pages){
        // Sanity check
        if(!isset($pages) || !is_array($pages) || empty($pages)) throw new Exception('$pages trebuie sa contina un array cu datele fiecarei pagini reprezentate intr-un sub-array');

        // Set method and action
        $method = 'home';
        $action = 'savePages';

        // Set data
        $data = array($pages);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}