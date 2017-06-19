<?php
namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsUpdate {

    /**
     * [RO] Actualizeaza un array de produse. Fiecare produs are un array de caracteristici.
     * [EN] Update an array of products. Each product has an array of characteristics.
     * @param $arrProducts
     * @throws \Exception
     */
    public function updateStockAndPrice($arrProducts){
        // Sanity check - for older versions of PHP
        if(!is_array($arrProducts) || empty($arrProducts)) throw new \Exception('Functia primeste ca parametru un array cu datele fiecarui produs grupate intr-un sub-array');

        // Set method and action
        $method = 'products';
        $action = 'UpdateStockAndPrice';

        // Set data
        $data = array('products' => $arrProducts);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * Updates an already existing product's data
     * @param $arrProducts
     * @throws \Exception
     */
    public function updateData($arrProducts){
        // Sanity check
        if(!is_array($arrProducts) || empty($arrProducts)) throw new \Exception('Functia primeste ca parametru un array cu datele fiecarui produs grupate intr-un sub-array');

        // Set method and action
        $method = 'products';
        $action = 'saveProducts';

        // Set data
        $data = array('products' => json_encode($arrProducts));

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}