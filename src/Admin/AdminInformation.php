<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminInformation {

    /**
     * [RO] Preia taxa de transport (https://github.com/celdotro/marketplace/wiki/Preia-taxa-de-transport)
     * [EN] Retrieves the transport tax (https://github.com/celdotro/marketplace/wiki/Get-transport-tax)
     * @param null $id
     * @return mixed
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
     * @param null $newLimit
     * @return mixed
     * @throws \Exception
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
     * @throws \Exception
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
     * @throws \Exception
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
}