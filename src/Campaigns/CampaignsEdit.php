<?php

namespace celmarket\Campaigns;

use celmarket\Dispatcher;

class CampaignsEdit {

    /**
     * [RO] Actualizeaza detaliile unei campanii si adauga un discount (https://github.com/celdotro/marketplace/wiki/Salvare-campanie)
     * [EN] Updates the campaign details and adds a discount (https://github.com/celdotro/marketplace/wiki/Save-Campaign)
     * @param $name
     * @param $newName
     * @param $dateStart
     * @param $dateEnd
     * @param $discount
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * [RO] Actualizeaza un produs cu un pret promotional diferit de cel implicit al campaniei (https://github.com/celdotro/marketplace/wiki/Salvare-produs-in-campanie)
     * [EN] Updates a product with a promotional price different than the campaign default (https://github.com/celdotro/marketplace/wiki/Save-Product-in-Campaign)
     * @param $name
     * @param $model
     * @param $promoPrice
     * @param $start
     * @param $end
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function saveProduct($name, $model, $promoPrice, $start, $end){
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
            'promo'         =>  $promoPrice,
            'start'         =>  $start,
            'end'           =>  $end
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Adauga un produs unei campanii si ii aplica reducerea acestia (https://github.com/celdotro/marketplace/wiki/Adaugare-produs-in-campanie)
     * [EN] Adds a product to a campaign and applies the campaign's discount (https://github.com/celdotro/marketplace/wiki/Add-Product-to-Campaign)
     * @param $name
     * @param $model
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * [RO] Elimina un produs dintr-o campanie (https://github.com/celdotro/marketplace/wiki/Eliminare-produs-din-campanie)
     * [EN] Removes a product from any campaign (https://github.com/celdotro/marketplace/wiki/Remove-Product-from-Campaign)
     * @param $name
     * @param $model
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
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

    /**
     * [RO] Returneaza informatiile aferente unei comenzi specificata prin parametru (https://github.com/celdotro/marketplace/wiki/Datele-comenzii)
     * [EN] Returns all relevant informations for an order specified as a parameter (https://github.com/celdotro/marketplace/wiki/Order-data)
     * @param $name
     * @param $stoc
     * @return mixed
     * @throws \Exception
     */
    public function setCampaignStoc($name, $stoc){
        // Sanity check
        if(!isset($name) || $name == '') throw new \Exception('Specificati numele campaniei');

        // Set method and action
        $method = 'campaign';
        $action = 'setCampaignStoc';

        // Set data
        $data = array(
            'name'  =>  $name,
            'stoc'         =>  $stoc,
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Generare cupon (https://github.com/celdotro/marketplace/wiki/Genereaza-cupon)
     * [EN] Coupon generation (https://github.com/celdotro/marketplace/wiki/Generate-coupon)
     * @param $campaignId
     * @param $couponsNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generateCoupons($campaignId, $couponsNumber){
        // Sanity check
        if(empty($campaignId)) throw new \Exception('Specificati o campanie valida');
        if(empty($couponsNumber)) throw new \Exception('Specificati un numar valid de cupoane');

        // Set method and action
        $method = 'coupons';
        $action = 'generateCoupons';

        // Set data
        $data = array(
            'campaignId'  =>  $campaignId,
            'couponsNumber' => $couponsNumber
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Schimbare status cupon (https://github.com/celdotro/marketplace/wiki/Schimbare-status-cupon)
     * [EN] Change coupon status (https://github.com/celdotro/marketplace/wiki/Change-coupon-status)
     * @param $campaignId
     * @param $couponId
     * @param $status
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function toggleCouponStatus($campaignId, $couponId, $status){
        // Sanity check
        if(empty($campaignId)) throw new \Exception('Specificati o campanie valida');
        if(empty($couponId)) throw new \Exception('Specificati un cupon valid');
        if(is_null($status)) throw new \Exception('Specificati un status valid');

        // Set method and action
        $method = 'coupons';
        $action = 'toggleCouponStatus';

        // Set data
        $data = array(
            'campaignId'  =>  $campaignId,
            'couponId' => $couponId,
            'status' => $status
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}