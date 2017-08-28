<?php
namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersList {

    /**
     * [RO] Listeaza comenzile unui client. Lista este scurtata folosind o pozitie
     * de start si o limita. Nu suporta mai mult de 50 inregistrari.
     * (https://github.com/celdotro/marketplace/wiki/Listare-comenzi)
     * [EN] List orders for a customer. It is shrunk by using a start position and a limit.
     * It can hold a maximum of 50 records.
     * (https://github.com/celdotro/marketplace/wiki/List-orders)
     * @param $start
     * @param $limit
     * @param $options
     * @param $status
     * @return mixed
     */
    public function listOrders($start, $limit, $options, $status = null){
        // Sanity check
        if(!isset($start) || !is_int($start)) throw new Exception('$start trebuie sa fie de tip integer');
        if(!isset($limit) || !is_int($limit)) throw new Exception('$limit trebuie sa fie de tip integer');
        if(!isset($options) || !is_array($options)) throw new Exception('$options trebuie sa fie un array');

        // Set method and action
        $method = 'orders';
        $action = 'getOrders';

        // Set data
        $data = array(
            'start' =>  $start,
            'limit' =>  $limit,
            'filters'  =>  json_encode($options),
        );

        if(!is_null($status)) $data['status'] = $status;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}