<?php

namespace celmarket\Campaigns;

use celmarket\Dispatcher;

class CampaignsEdit {

    /**
     * Updates the campaign details and adds a discount
     * @param $name
     * @param $newName
     * @param $dateStart
     * @param $dateEnd
     * @param $discount
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function saveCampaign($name, $newName, $dateStart, $dateEnd, $discount){
        // Sanity check
        if(!isset($name) || $name == '') throw new \Exception('Specificati numele campaniei');
        if(!isset($newName) || $newName == '') throw new \Exception('Specificati noul nume al campaniei');
        if(!isset($dateStart) || strtotime($dateStart) === false) throw new \Exception('Specificati o data de start valida');
        if(!isset($dateEnd) || strtotime($dateEnd) === false) throw new \Exception('Specficati o data de sfarsit valida');
        if(strtotime($dateStart) > strtotime($dateEnd)) throw new \Exception('Data de inceput trebuie sa fie mai mica sau egala cu data de sfarsit');
        if(!isset($discount) || $discount == '' || !is_numeric($discount)) throw new \Exception('Specificati un discount valid');

        // Set method and action
        $method = 'campaign';
        $action = 'saveCampaign';

        // Set data
        $data = array(
            'numecampanie'  =>  $name,
            'CampaignData'  =>  json_encode(
                array(
                    'numecampanie'  =>  $newName,
                    'datastart'     =>  $dateStart,
                    'dataend'       =>  $dateEnd,
                    'reducere'      =>  $discount
                )
            )
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * Updates a product with a promotional price different than the campaign default
     * @param $name
     * @param $model
     * @param $promoPrice
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function saveProduct($name, $model, $promoPrice){
        // Sanity check
        if(!isset($name) || $name == '') throw new \Exception('Specificati numele campaniei');
        if(!isset($model) && $model == '') throw new \Exception('Specificati modelul produsului');
        if(!isset($promoPrice) && $promoPrice < 0) throw new \Exception('Specificati pretul promo al produslui');

        // Set method and action
        $method = 'campaign';
        $action = 'saveProduct';

        // Set data
        $data = array(
            'numecampanie'  =>  $name,
            'model'         =>  $model,
            'promo'         =>  $promoPrice
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * Adds a product to a campaign and applies the campaign's discount
     * @param $name
     * @param $model
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function addProduct($name, $model){
        // Sanity check
        if(!isset($name) || $name == '') throw new \Exception('Specificati numele campaniei');
        if(!isset($model) && $model == '') throw new \Exception('Specificati modelul produsului');

        // Set method and action
        $method = 'campaign';
        $action = 'addProduct';

        // Set data
        $data = array(
            'numecampanie'  =>  $name,
            'model'         =>  $model,
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * Removes a product from any campaign
     * @param $name
     * @param $model
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function removeProduct($name, $model){
        // Sanity check
        if(!isset($name) || $name == '') throw new \Exception('Specificati numele campaniei');
        if(!isset($model) && $model == '') throw new \Exception('Specificati modelul produsului');

        // Set method and action
        $method = 'campaign';
        $action = 'removeProduct';

        // Set data
        $data = array(
            'numecampanie'  =>  $name,
            'model'         =>  $model,
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}