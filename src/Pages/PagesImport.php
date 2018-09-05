<?php

namespace celmarket\Pages;

use celmarket\Dispatcher;

class PagesImport {

    /**
     * [RO] Salveaza datele paginii (https://github.com/celdotro/marketplace/wiki/Salvare-pagina)
     * [EN] Save page data (https://github.com/celdotro/marketplace/wiki/Save-pages)
     * @param $pageID
     * @param $pageData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function savePage($pageID, $pageData){
        // Sanity check
        if(!isset($pageID) || !is_int($pageID)) throw new \Exception('Specificati un ID al paginii');
        if(!isset($pageData) || !is_array($pageData) || empty($pageData)) throw new \Exception('$pages trebuie sa contina un array cu datele paginii');

        // Set method and action
        $method = 'settings';
        $action = 'savePage';

        $data = array(
            'id' => $pageID
        );
        foreach($pageData as $key => $value){
            $data[$key] = $value;
        }

        // Set data
        $data = array($data);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}