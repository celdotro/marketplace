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
     * @throws \GuzzleHttp\Exception\GuzzleException
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

    /**
     * [RO] Adaugare campanie cupoane noua (https://github.com/celdotro/marketplace/wiki/Adaugare-Campanie-Cupoane-Noua)
     * [EN] Add new coupon campaign (https://github.com/celdotro/marketplace/wiki/Add-New-Coupon-Campaign)
     * @param $name
     * @param $description
     * @param $discountType
     * @param $value
     * @param $minOrder
     * @param $totalUtilize
     * @param $userUtilize
     * @param $dateStart
     * @param $dateEnd
     * @param $domainRestriction
     * @param $productRestrictions
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function saveCouponsCampaign($name, $description, $discountType, $value, $minOrder, $totalUtilize, $userUtilize, $dateStart, $dateEnd, $domainRestriction, $productRestrictions){
        // Sanity check
        if(!isset($name) || $name == '') throw new \Exception('Specificati numele campaniei');
        if(!isset($dateStart) || strtotime($dateStart) === false) throw new \Exception('Specificati o data de start valida');
        if(!isset($dateEnd) || strtotime($dateEnd) === false) throw new \Exception('Specficati o data de sfarsit valida');
        if(strtotime($dateStart) > strtotime($dateEnd)) throw new \Exception('Data de inceput trebuie sa fie mai mica sau egala cu data de sfarsit');

        // Set method and action
        $method = 'coupons';
        $action = 'saveCouponsCampaign';

        // Set data
        $data = array(
            'name' => $name,
            'description' => $description,
            'discountType' => $discountType,
            'value' => $value,
            'minOrder' => $minOrder,
            'totalUtilize' => $totalUtilize,
            'userUtilize' => $userUtilize,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
            'domainRestriction' => $domainRestriction,
            'productRestrictions' => $productRestrictions
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}