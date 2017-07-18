<?php
namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersList {

    /**
     * [RO] Listeaza comenzile unui client filtrate in functie de data. Lista poate fi scurtata folosind o pozitie
     * de start si o limita. Nu suporta mai mult de 10 inregistrari. Prima categorie va avea implicit numele "parent".
     * (https://github.com/celdotro/marketplace/wiki/Listare-comenzi)
     * [EN] List orders for a customer filtered by date. It can be shrunk using a start position and a limit.
     * It can hold a maximum of 10 records. The first category will be named 'parent'.
     * (https://github.com/celdotro/marketplace/wiki/List-orders)
     * @param $start
     * @param $limit
     * @param $options
     * @return mixed
     */
    public function listOrders($start, $limit, $options){
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

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}