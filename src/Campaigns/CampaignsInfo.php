<?php

namespace celmarket\Campaigns;

use celmarket\Dispatcher;

class CampaignsInfo {

    /**
     * [RO] Returneaza informatii referitoare la o campanie, produsele din ea filtrate in functie de nume, precum si alte produse disponibile care pot, de asemenea, sa fie filtrate in functie de nume (https://github.com/celdotro/marketplace/wiki/Citire-campanie)
     * [EN] Provides information about a campaign, its products that can be filtered by name and other available products that can also be filtered by name (https://github.com/celdotro/marketplace/wiki/Read-Campaign)
     * @param $name
     * @param $products
     * @param $availableProducts
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function readCampaign($name, $products, $availableProducts){
        // Sanity check
        if(!isset($name) || $name == '') throw new \Exception('Specificati numele campaniei');
        if(!isset($products)) throw new \Exception('Specificati produsele');
        if(!isset($availableProducts)) throw new \Exception('Specificati produsele disponibile');

        // Set method and action
        $method = 'campaign';
        $action = 'readCampaign';

        // Set data
        $data = array(
            'numecampanie'      =>  $name,
            'products'          =>  json_encode($products),
            'availableProducts' =>  json_encode($availableProducts)
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza toate campaniile active. Datele pot fi filtrate in functie de data de inceput, data de sfarsit si numele campaniei (https://github.com/celdotro/marketplace/wiki/Listare-campanii-active)
     * [EN] Lists all active campaigns. Data can be filtered by start date, end date, and campaign name. (https://github.com/celdotro/marketplace/wiki/List-Active-Campaigns)
     * @param $start
     * @param $limit
     * @param null $dateFrom
     * @param null $dateTo
     * @param null $search
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listActiveCampaigns($start, $limit, $dateFrom = NULL, $dateTo = NULL, $search = NULL){
        // Sanity check
        if(!isset($start) || $start === '' || !is_int($start))
            throw new \Exception('Specificati valoarea de start');
        if(!isset($limit) || $limit === '' || !is_int($limit))
            throw new \Exception('Specificati o valoare limita');
        if(isset($dateFrom)){
            if(strtotime($dateFrom) === false)
                throw new \Exception('Specificati o data de inceput valida');
            else // Add to data if everything is OK
                $data['date_from'] = $dateFrom;
        }
        if(isset($dateTo)){
            if(strtotime($dateTo) === false)
                throw new \Exception('Specificati o data de sfarsit valida');
            else // Add to data if everything is OK
                $data['date_to'] = $dateTo;
        }
        if(isset($search)) {
            if($search !== '') // Add to data if everything is OK
                $data['search'] = $search;
        }

        // Set method and action
        $method = 'campaign';
        $action = 'activeCampaigns';

        // Add additional values to $data array
        $data['start'] = $start;
        $data['limit'] = $limit;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia toate campaniile de cupoane (https://github.com/celdotro/marketplace/wiki/Preia-cupoanele-campaniei)
     * [EN] Retrieves a list of coupon campaigns (https://github.com/celdotro/marketplace/wiki/Get-Coupon-Campaigns)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCouponCampaigns(){
        // Set method and action
        $method = 'coupons';
        $action = 'getCouponCampaigns';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }

    /**
     * [RO] Datele aferente unei campanii de cupoane (https://github.com/celdotro/marketplace/wiki/Date-campanie-cupoane)
     * [EN] Get coupon campaign data (https://github.com/celdotro/marketplace/wiki/Coupon-Campaign-Data)
     * @param $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCouponCampaign($id){
        // Sanity check
        if(empty($id)) throw new \Exception('Specificati un ID valid');

        // Set method and action
        $method = 'coupons';
        $action = 'getCouponsCampaignData';

        $send = array(
            'campaignId' => $id
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $send);

        return $result;
    }

    /**
     * [RO] Verifica utilizarea cuponului (https://github.com/celdotro/marketplace/wiki/Verifica-utilizarea-cuponului)
     * [EN] Check coupon's usage (https://github.com/celdotro/marketplace/wiki/Check-coupon-usage)
     * @param $campaignId
     * @param $couponId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkCouponUsage($campaignId, $couponId){
        // Sanity check
        if(empty($campaignId)) throw new \Exception('Specificati un ID de campanie valid');
        if(is_null($couponId)) throw new \Exception('Specificati un ID de cupon valid');

        // Set method and action
        $method = 'coupons';
        $action = 'checkCouponUsage';

        $send = array(
            'campaignId' => $campaignId,
            'couponId' => $couponId
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $send);

        return $result;
    }

    /**
     * [RO] Preia date cupon (https://github.com/celdotro/marketplace/wiki/Date-cupon)
     * [EN] Get coupon data (https://github.com/celdotro/marketplace/wiki/Coupon-data)
     * @param $couponId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCouponData($couponId){
        // Sanity check
        if(is_null($couponId)) throw new \Exception('Specificati un ID de cupon valid');

        // Set method and action
        $method = 'coupons';
        $action = 'getCouponData';

        $send = array(
            'couponId' => $couponId
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $send);

        return $result;
    }
}