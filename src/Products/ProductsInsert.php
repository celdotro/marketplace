<?php
namespace celmarket\Products;

use celmarket\Dispatcher;


class ProductsInsert {

    /**
     * Insert/Update an array of products. Each product has an array of characteristics.
     * @param array $arrProducts
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function importProducts($arrProducts = array()){
        // Sanity check - for older versions of PHP
        if(!is_array($arrProducts)) throw new \Exception('Functia primeste ca parametru un array cu datele fiecarui produs grupate intr-un sub-array');

        // Set method and action
        $method = 'products';
        $action = 'ImportProducts';

        // Set data
        $data = array('products' => $arrProducts);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}