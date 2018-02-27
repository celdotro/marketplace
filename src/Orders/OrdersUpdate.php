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

    /**
     * [RO] Schimba statusul unui produs dintr-o comanda (https://github.com/celdotro/marketplace/wiki/Schimba-statusul-unui-produs-din-comanda)
     * [EN] Changes the status of a product from a specific order (https://github.com/celdotro/marketplace/wiki/Change-order-product-status)
     * @param $orders_products_id
     * @param $status
     * @return mixed
     * @throws \Exception
     */
    public function changeOrderProductStatus($orders_products_id, $status){
        // Sanity check
        if(empty($orders_products_id)) throw new \Exception('Specificati ID-ul produsului');
        if(!isset($status)) throw new \Exception('Specificati statusul produsului');

        // Set method and action
        $method = 'orders';
        $action = 'changeOrderProductStatus';

        // Set data
        $data = array(
            'orders_products_id' => $orders_products_id,
            'status' => $status
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function changeOrderPaymentMethod($order, $paymentMethod){
        // Sanity check
        if(empty($order)) throw new \Exception('Comanda invalida');
        if(empty($paymentMethod)) throw new \Exception('Mod de plata invalid');

        // Set method and action
        $method = 'orders';
        $action = 'ChangeOrderPaymentMethod';

        // Set data
        $data = array(
            'order_id' => $order,
            'payment_method' => $paymentMethod
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}