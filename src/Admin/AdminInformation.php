<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminInformation {

    /**
     * [RO] Preia taxa de transport (https://github.com/celdotro/marketplace/wiki/Preia-taxa-de-transport)
     * [EN] Retrieves the transport tax (https://github.com/celdotro/marketplace/wiki/Get-transport-tax)
     * @param null $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTransportTax($id = null){
        // Set method and action
        $method = 'admininfo';
        $action = 'getTransportTax';

        // Set data
        if(!is_null($id)) $data = array('id' => $id);
        else $data = array();

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Actualizeaza o taxa de transport (https://github.com/celdotro/marketplace/wiki/Actualizeaza-taxa-de-transport)
     * [EN] Updates a transport tax (https://github.com/celdotro/marketplace/wiki/Update-transport-tax)
     * @param $id
     * @param null $newValue
     * @param null $impusa
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateTransportTax($id, $newValue = null, $impusa = null){
        // Sanity check
        if(is_null($newValue) && is_null($impusa)) throw new \Exception('Limita sau valoarea trebuie sa fie nenule');
        // Set method and action
        $method = 'admininfo';
        $action = 'updateTransportTax';

        // Set data
        $data = array('id' => $id);
        if(!is_null($newValue)) $data['newValue'] = $newValue;
        if(!is_null($impusa)) $data['impusa'] = $impusa;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Actualizeaza in grup toate taxele de transport pentru categoriile disponibile (https://github.com/celdotro/marketplace/wiki/Actualizare-in-grup-a-taxelor-de-transport)
     * [EN] Updates all transport taxes for available categories (https://github.com/celdotro/marketplace/wiki/Bulk-update-transport-taxes)
     * @param null $newValue
     * @param null $newLimit
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function insertTaxForAllCategories($newValue = null, $newLimit = null){
        // Sanity check
        if(is_null($newValue) && is_null($newLimit)) throw new \Exception('Limita sau valoarea trebuie sa fie nenule');
        // Set method and action
        $method = 'admininfo';
        $action = 'insertTaxForAllCategories';

        // Set data
        if(!is_null($newValue)) $data['newValue'] = $newValue;
        if(!is_null($newLimit)) $data['newLimit'] = $newLimit;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Actualizeaza informatiil referitoare la taxele percepute pentru livrare (https://github.com/celdotro/marketplace/wiki/Actualizeaza-informatiile-livrarii)
     * [EN] Updates information about delivery taxes (https://github.com/celdotro/marketplace/wiki/Update-delivery-information)
     * @param null $minimTara
     * @param null $minimBucuresti
     * @param null $kgIncluse
     * @param null $pretKgInPlus
     * @param null $deschidereColet
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateDeliveryInformation($minimTara = null, $minimBucuresti = null, $kgIncluse = null, $pretKgInPlus = null, $deschidereColet = null){
        // Set method and action
        $method = 'admininfo';
        $action = 'updateDeliveryInformation';

        // Set data
        $data = array();
        if(!is_null($minimTara)) $data['minim_tara'] = $minimTara;
        if(!is_null($minimBucuresti)) $data['minim_bucuresti'] = $minimBucuresti;
        if(!is_null($kgIncluse)) $data['kgincluse'] = $kgIncluse;
        if(!is_null($pretKgInPlus)) $data['pretkginplus'] = $pretKgInPlus;
        if(!is_null($deschidereColet)) $data['deschiderecolet'] = $deschidereColet;

        // Late sanity check
        if(empty($data)) throw new \Exception('Specificati cel putin 1 informatie');

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia informatiile despre taxele de livrare (https://github.com/celdotro/marketplace/wiki/Preia-informatii-despre-livrare)
     * [EN] Get information about delivery taxes (https://github.com/celdotro/marketplace/wiki/Get-delivery-information)
     * @param null $newValue
     * @param null $newLimit
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDeliveryInformation($newValue = null, $newLimit = null){
        // Set method and action
        $method = 'admininfo';
        $action = 'getDeliveryInformation';

        // Set data
        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia lista curierilor (https://github.com/celdotro/marketplace/wiki/Preia-lista-curieri)
     * [EN] Get couriers list (https://github.com/celdotro/marketplace/wiki/Get-couriers)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCouriers(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getCouriers';

        // Set data
        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia categoriile cu FAQ (https://github.com/celdotro/marketplace/wiki/Preia-FAQ-categorii)
     * [EN] Retrieves categories with FAQ (https://github.com/celdotro/marketplace/wiki/Get-categories-FAQ)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCategoriesFaq(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getCategoriesFaq';

        // Set data
        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia continutul FAQ pentru o categorie (https://github.com/celdotro/marketplace/wiki/Continut-FAQ-categorie)
     * [EN] Retrieve a category's FAQ contents (https://github.com/celdotro/marketplace/wiki/Category-FAQ-contents)
     * @param $category
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCategoryFaqContent($category){
        // Sanity check
        if(empty($category)) throw new \Exception('Categorie invalida');

        // Set method and action
        $method = 'admininfo';
        $action = 'getCategoryFaqContent';

        // Set data
        $data = array('category' => $category);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia toate codurile MCC (https://github.com/celdotro/marketplace/wiki/Preia-coduri-MCC)
     * [EN] Get all MCC Codes (https://github.com/celdotro/marketplace/wiki/Get-MCC-Codes)
     * @param array $filters
     * @param int $start
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMccCodes($filters = array(), $start = 0){
        // Set method and action
        $method = 'admininfo';
        $action = 'getMccCodes';

        // Set data
        $data = array('filters' => $filters, 'start' => $start);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Adauga un cod MCC in contul curent (https://github.com/celdotro/marketplace/wiki/Atribuie-cod-MCC)
     * [EN] Add an MCC code to current account (https://github.com/celdotro/marketplace/wiki/Add-MCC-Code)
     * @param $mcc
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addMccCode($mcc){
        // Set method and action
        $method = 'admininfo';
        $action = 'addMccCode';

        // Set data
        $data = array('mcc' => $mcc);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia lista MCC-urilor atribuite (https://github.com/celdotro/marketplace/wiki/Preia-MCC-uri-atribuite)
     * [EN] Get list of currently used MCC (https://github.com/celdotro/marketplace/wiki/Get-currently-used-MCC)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCurrentMcc(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getCurrentMcc';

        // Set data
        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Elimina un MCC atribuit contului curent (https://github.com/celdotro/marketplace/wiki/Elimina-MCC)
     * [EN] Remove an MCC code linked to the current account (https://github.com/celdotro/marketplace/wiki/Remove-MCC-Code)
     * @param $mcc
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeMccCode($mcc){
        // Set method and action
        $method = 'admininfo';
        $action = 'removeMccCode';

        // Set data
        $data = array('mcc' => $mcc);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia date referitoare la accesul la categorii (https://github.com/celdotro/marketplace/wiki/Preia-accesul-la--categorii)
     * [EN] Retrieve information about category access (https://github.com/celdotro/marketplace/wiki/Retrieve-category-access)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCategoriesAccess(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getCategoriesAccess';

        // Set data
        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Cere acces la o categorie (https://github.com/celdotro/marketplace/wiki/Cere-acces-la-o-categorie)
     * [EN] Request access to category (https://github.com/celdotro/marketplace/wiki/Request-category-access)
     * @param $categ_id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function requestCategoryAccess($categ_id){
        // Set method and action
        $method = 'admininfo';
        $action = 'requestCategoryAccess';

        // Set data
        $data = array('categ_id' => $categ_id);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}