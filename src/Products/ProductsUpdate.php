<?php
namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsUpdate {

    /**
     * [RO] Actualizeaza datele produselor deja existente (https://github.com/celdotro/marketplace/wiki/Actualizeaza-date-produs)
     * [EN] Updates an already existing product's data (https://github.com/celdotro/marketplace/wiki/Update-product-data)
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