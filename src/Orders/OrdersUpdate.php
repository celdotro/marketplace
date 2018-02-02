<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersUpdate {

    /**
     * [RO] Actualizeaza produsele pentru o comanda (https://github.com/celdotro/marketplace/wiki/Actualizare-comenzi)
     * [EN] Update the products of an order (https://github.com/celdotro/marketplace/wiki/Update-orders)
     * @param $cmd
     * @param $arrProducts
     * @return mixed
     * @throws \Exception
     */
    public function updateProductsFromOrder($cmd, $arrProducts){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($arrProducts) || !is_array($arrProducts) || empty($arrProducts)) throw new \Exception('$arrProducts trebuie sa fie un array care sa contina un alt array cu datele produselor pe care doriti sa le actualizati in comanda');

        // Set method and action
        $method = 'orders';
        $action = 'saveOrderData';

        // Set data
        $data = array('order' => $cmd, 'data' => json_encode($arrProducts));

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Adauga noi produse intr-o comanda existenta (https://github.com/celdotro/marketplace/wiki/Adaugarea-de-noi-produse-in-comanda)
     * [EN] Add new products to an existing order (https://github.com/celdotro/marketplace/wiki/Adaugarea-de-noi-produse-in-comanda)
     * @param $cmd
     * @param $arrProducts
     * @return mixed
     * @throws \Exception
     */
    public function addProductsToOrder($cmd, $arrProducts){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($arrProducts) || !is_array($arrProducts) || empty($arrProducts)) throw new \Exception('$arrProducts trebuie sa fie un array care sa contina un alt array cu datele produselor pe care doriti sa le actualizati in comanda');

        // Set method and action
        $method = 'orders';
        $action = 'addProductsToOrder';

        // Set data
        $data = array('order' => $cmd, 'data' => json_encode($arrProducts));

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Sterge un produs dintr-o comanda existenta (https://github.com/celdotro/marketplace/wiki/Stergerea-unui-model-de-produs-din-comanda)
     * [EN] Remove a product model from an existing order (https://github.com/celdotro/marketplace/wiki/Remove-product-model-from-order)
     * @param $cmd
     * @param $arrProducts
     * @return mixed
     * @throws \Exception
     */
    public function removeProductsFromOrder($cmd, $arrProducts){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
        if(!isset($arrProducts) || !is_array($arrProducts) || empty($arrProducts)) throw new \Exception('$arrProducts trebuie sa fie un array care sa contina un alt array cu datele produselor pe care doriti sa le actualizati in comanda');

        // Set method and action
        $method = 'orders';
        $action = 'removeProductsFromOrder';

        // Set data
        $data = array('order' => $cmd, 'data' => json_encode($arrProducts));

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function importInvoice($cmd, $serie, $nr_fact){
      // Sanity check
      if(empty($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');
      if(empty($serie)) throw new \Exception('Specificati seria facturii');
      if(empty($nr_fact)) throw new \Exception('Specificati numarul  facturii');

      // Set method and action
      $method = 'orders';
      $action = 'importInvoice';

      // Set data
      $data = array(
          'orders_id' => $cmd,
          'serie' => $serie,
          'nr_fact' => $nr_fact
      );

      // Send request and retrieve response
      $result = Dispatcher::send($method, $action, $data);

      return $result;
    }

    public function editDeliveryAddress($orders_id, $name, $address, $county, $city, $phone){
        // Sanity check
        if(empty($orders_id)) throw new \Exception('Specificati comanda');
        if(empty($name)) throw new \Exception('Specificati numele');
        if(empty($address)) throw new \Exception('Specificati adresa');
        if(empty($county)) throw new \Exception('Specificati judetul');
        if(empty($city)) throw new \Exception('Specificati orasul');
        if(empty($phone)) throw new \Exception('Specificati telefonul');

        // Set method and action
        $method = 'orders';
        $action = 'editDeliveryAddress';

        // Set data
        $data = array(
            'orders_id' => $orders_id,
            'name' => $name,
            'address' => $address,
            'county' => $county,
            'city' => $city,
            'phone' => $phone
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}