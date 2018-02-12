<?php
namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsUpdate {

    /**
     * [RO] Actualizeaza datele produselor deja existente (https://github.com/celdotro/marketplace/wiki/Actualizeaza-date-produs)
     * [EN] Updates an already existing product's data (https://github.com/celdotro/marketplace/wiki/Update-product-data)
     * @param $arrProducts
     * @return mixed
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

    /**
     * [RO] Actualizeaza statusul unui produs (https://github.com/celdotro/marketplace/wiki/Actualizare-status-produs)
     * [EN] Update product's status (https://github.com/celdotro/marketplace/wiki/Update-product-status)
     * @param $model
     * @param $status
     * @return mixed
     * @throws \Exception
     */
    public function updateStatus($model, $status){
        // Sanity check
        if(empty($model)) throw new \Exception('Specificati modelul produsului');

        // Set method and action
        $method = 'products';
        $action = 'updateStatus';

        // Set data
        $data = array(
            'model' => $model,
            'status' => $status
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}