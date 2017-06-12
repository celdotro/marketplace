<?php
namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsUpdate {

    /**
     * [RO] Actualizeaza un array de produse. Fiecare produs are un array de caracteristici.
     * [EN] Update an array of products. Each product has an array of characteristics.
     * @param $arrProducts
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateStockAndPrice($arrProducts){
        // Sanity check - for older versions of PHP
        if(!is_array($arrProducts)) throw new Exception('Functia primeste ca parametru un array cu datele fiecarui produs grupate intr-un sub-array');

        // Set method and action
        $method = 'products';
        $action = 'UpdateStockAndPrice';

        // Set data
        $data = array('products' => $arrProducts);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}