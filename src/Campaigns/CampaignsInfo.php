<?php

namespace celmarket\Campaigns;

use celmarket\Dispatcher;

class CampaignsInfo {

    /**
     * [RO] Returneaza informatii referitoare la o campanie, produsele din ea filtrate in functie
     * de nume, precum si alte produse disponibile care pot, de asemenea, sa fie filtrate in functie de nume
     * [EN] Provides information about a campaign, its products that can be filtered by name
     * and other available products that can also be filtered by name
     * @param $name
     * @param $products
     * @param $availableProducts
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
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
     * Listeaza toate campaniile active. Datele pot fi filtrate in functie de data de inceput, data de sfarsit si
     * numele campaniei
     * [EN] Lists all active campaigns. Data can be filtered by start date, end date, and campaign name.
     * @param $start
     * @param $limit
     * @param null $dateFrom
     * @param null $dateTo
     * @param null $search
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listActiveCampaigns($start, $limit, $dateFrom = NULL, $dateTo = NULL, $search = NULL){
        // Sanity check
        if(!isset($start) || $start === '' || !is_int($start))
            throw new Exception('Specificati valoarea de start');
        if(!isset($limit) || $limit === '' || !is_int($limit))
            throw new Exception('Specificati o valoare limita');
        if(isset($dateFrom)){
            if(strtotime($dateFrom) === false)
                throw new Exception('Specificati o data de inceput valida');
            else // Add to data if everything is OK
                $data['date_from'] = $dateFrom;
        }
        if(isset($dateTo)){
            if(strtotime($dateTo) === false)
                throw new Exception('Specificati o data de sfarsit valida');
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
}