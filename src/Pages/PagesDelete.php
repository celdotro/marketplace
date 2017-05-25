<?php

namespace celmarket\Pages;

use celmarket\Dispatcher;

class PagesDelete {

    public function deletePages($pages){
        // Sanity check
        if(!isset($pages) || !is_array($pages) || empty($pages)) throw new Exception('$pages trebuie sa contina un array cu id-urile paginilor ce vor fi sterse');

        // Set method and action
        $method = 'home';
        $action = 'DeletePages';

        // Set data
        $data = array($pages);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}