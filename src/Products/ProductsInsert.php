<?php
namespace celmarket\Products;

use celmarket\Dispatcher;


class ProductsInsert {

    /**
     * [RO] Insereaza/Actualizeaza un array de produse. Fiecare produs are un array de date relevante. (https://github.com/celdotro/marketplace/wiki/Import-produse)
     * [EN] Insert/Update an array of products. Each product has an array of relevant data. (https://github.com/celdotro/marketplace/wiki/Import-products)
     * @param array $arrProducts
     * @throws \Exception
     */
    public function importProducts($arrProducts = array()){
        // Sanity check - for older versions of PHP
        if(!is_array($arrProducts)) throw new \Exception('Functia primeste ca parametru un array cu datele fiecarui produs grupate intr-un sub-array');

        // Set method and action
        $method = 'import';
        $action = 'importer';

        // Set data
        $data = array('products' => $arrProducts);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}