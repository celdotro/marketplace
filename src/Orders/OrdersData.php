<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersData {

    /**
     * [RO] Preia datele asociate cu o anumita comanda (https://github.com/celdotro/marketplace/wiki/Datele-comenzii)
     * [EN] Retrieve data associated with an order (https://github.com/celdotro/marketplace/wiki/Order-data)
     * @param $cmd
     * @param bool $original_delivery
     * @return mixed
     * @throws \Exception
     */
    public function getOrderInfo($cmd, $original_delivery = false){
        // Sanity check - for older versions of PHP
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati un ID valid al comenzii');

        // Set method and action
        $method = 'orders';
        $action = 'getOrder';

        // Set data
        $data = array('order' => $cmd, 'original_delivery' => $original_delivery);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Verifica daca pentru o anumita comanda a fost efectuata plata (https://github.com/celdotro/marketplace/wiki/Verifica-plata-pentru-comanda)
     * [EN] Checks if the payment was made for a specific order (https://github.com/celdotro/marketplace/wiki/Check-payment-for-order)
     * @param $cmd
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkPaymentForOrder($cmd){
        // Sanity check - for older versions of PHP
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati un ID valid al comenzii');

        // Set method and action
        $method = 'orders';
        $action = 'checkPaymentForOrder';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Actualizeaza SN-ul unui produs comandat (https://github.com/celdotro/marketplace/wiki/Actualizare-SN)
     * [EN] Updates an ordered product's SN (https://github.com/celdotro/marketplace/wiki/Update-SN)
     * @param $id_disp_fact
     * @param $products
     * @param $sn
     * @param $nr
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updatesn($id_disp_fact, $products, $sn, $nr){
        // Sanity check
        if(empty($id_disp_fact)) throw new \Exception('Specificati un ID valid al dispozitiei de facturare');
        if(empty($products)) throw new \Exception('Specificati o lista valida de produse');

        // Set method and action
        $method = 'orders';
        $action = 'updateSN';

        // Set data
        $data = array(
            'id_disp_fact' => $id_disp_fact,
            'products' => $products,
            'sn' => $sn,
            'nr' => $nr
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Adauga observatii comenzii (https://github.com/celdotro/marketplace/wiki/Adauga-observatii-comanda)
     * [EN] Add order observations (https://github.com/celdotro/marketplace/wiki/Add-Order-Observations)
     * @param $orders_id
     * @param $observations
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addOrderObservations($orders_id, $observations){
        // Sanity check
        if(empty($orders_id)) throw new \Exception('Specificati un ID valid de comanda');

        // Set method and action
        $method = 'orders';
        $action = 'addOrderObservations';

        // Set data
        $data = array(
            'orders_id' => $orders_id,
            'observations' => $observations
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Returneaza un document PDF cu datele comenzii (https://github.com/celdotro/marketplace/wiki/Tipareste-comanda)
     * [EN] Returns a PDF with the order's details (https://github.com/celdotro/marketplace/wiki/Print-order)
     * @param $orders_id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function printOrder($orders_id){
        // Sanity check
        if(empty($orders_id)) throw new \Exception('Specificati un ID valid de comanda');

        // Set method and action
        $method = 'orders';
        $action = 'printOrder';;

        // Set data
        $data = array(
            'orders_id' => $orders_id
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Finalizeaza o comanda parcurgand automat toti pasii (https://github.com/celdotro/marketplace/wiki/Finalizere-combinata-a-comenzii)
     * [EN] Finishes an order by automatically taking all the necessary steps (https://github.com/celdotro/marketplace/wiki/Finish-order-combined)
     * @param $orders_id
     * @param $serie
     * @param $nr_fact
     * @param $awb
     * @param $idAdresaRidicare
     * @param $observations
     * @param $products
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function finishOrderCombined($orders_id, $serie, $nr_fact, $awb, $idAdresaRidicare, $observations, $products, $autogenerateAwb){
        // Sanity check
        if(empty($orders_id)) throw new \Exception('Specificati un ID valid de comanda');

        // Set method and action
        $method = 'orders';
        $action = 'finishOrderCombined';

        // Set data
        $data = array(
            'orders_id' => $orders_id,
            'serie' => $serie,
            'nr_fact' => $nr_fact,
            'awb' => $awb,
            'idAdresaRidicare' => $idAdresaRidicare,
            'observations' => $observations,
            'products' => $products,
            'autogenerateAwb' => $autogenerateAwb
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}