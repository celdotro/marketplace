<?php

namespace celmarket\Campaigns;

use celmarket\Dispatcher;

class CampaignsCreate {

    /**
     * [RO] Creaza o noua campanie si ii seteaza numele, data de inceput si data de sfarsit (https://github.com/celdotro/marketplace/wiki/Adaugare-campanie)
     * [EN] Creates a new campaign and sets its name, start date and end date (https://github.com/celdotro/marketplace/wiki/Add-Campaign)
     * @param $name
     * @param $dateStart
     * @param $dateEnd
     * @return mixed
     * @throws \Exception
     */
    public function newCampaign($name, $dateStart, $dateEnd){
        // Sanity check
        if(!isset($name) || $name == '') throw new \Exception('Specificati numele campaniei');
        if(!isset($dateStart) || strtotime($dateStart) === false) throw new \Exception('Specificati o data de start valida');
        if(!isset($dateEnd) || strtotime($dateEnd) === false) throw new \Exception('Specficati o data de sfarsit valida');
        if(strtotime($dateStart) > strtotime($dateEnd)) throw new \Exception('Data de inceput trebuie sa fie mai mica sau egala cu data de sfarsit');

        // Set method and action
        $method = 'campaign';
        $action = 'newCampaign';

        // Set data
        $data = array(
            'numecampanie'  =>  $name,
            'datastart'     =>  $dateStart,
            'dataend'       =>  $dateEnd
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array('newCampaignData' => json_encode($data)));

        return $result;
    }
}