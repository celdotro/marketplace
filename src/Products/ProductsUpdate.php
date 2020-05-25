<?php
namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsUpdate {

    /**
     * [RO] Actualizeaza datele produselor deja existente (https://github.com/celdotro/marketplace/wiki/Actualizeaza-date-produs)
     * [EN] Updates an already existing product's data (https://github.com/celdotro/marketplace/wiki/Update-product-data)
     * @param $arrProducts
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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

    /**
     * [RO] Adauga un produs intr-o familie de produse (https://github.com/celdotro/marketplace/wiki/Adauga-produs-in-familie)
     * [EN] Add a product to a product family (https://github.com/celdotro/marketplace/wiki/Add-product-to-family)
     * @param $familyId
     * @param $model
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addProductToFamily($familyId, $model){
        // Sanity check
        if(empty($model)) throw new \Exception('Specificati modelul produsului');
        if(empty($familyId)) throw new \Exception('Specificati familia produsului');

        // Set method and action
        $method = 'products';
        $action = 'addProductToFamily';

        // Set data
        $data = array(
            'model' => $model,
            'familyId' => $familyId
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Elimina produs din familie (https://github.com/celdotro/marketplace/wiki/Elimina-produs-din-familie)
     * [EN] Remove product from family (https://github.com/celdotro/marketplace/wiki/Remove-product-from-family)
     * @param $model
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeProductFromFamily($model){
        // Sanity check
        if(empty($model)) throw new \Exception('Specificati modelul produsului');

        // Set method and action
        $method = 'products';
        $action = 'removeProductFromFamily';

        // Set data
        $data = array(
            'model' => $model
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Actualizeaza promotia unui produs (https://github.com/celdotro/marketplace/wiki/Actualizare-promotie-produs)
     * [EN] Update product's promotion (https://github.com/celdotro/marketplace/wiki/Update-product-promotion)
     * @param $model
     * @param $promotion
     * @return mixed
     * @throws \Exception
     */
    public function updatePromotion($model, $promotion){
        // Sanity check
        if(empty($model)) throw new \Exception('Specificati modelul produsului');
        if(!in_array($promotion, array(0, 1, 2))) throw new \Exception('Specificati o promotie valida');

        // Set method and action
        $method = 'products';
        $action = 'updatePromotion';

        // Set data
        $data = array(
            'model' => $model,
            'promotion' => $promotion
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Adauga o familie de produse (https://github.com/celdotro/marketplace/wiki/Adauga-familie-de-produse)
     * [EN] Add a products family (https://github.com/celdotro/marketplace/wiki/Add-products-family)
     * @param $id
     * @param $name
     * @param $characts
     * @return mixed
     * @throws \Exception
     */
    public function addProductsFamily($id, $categ_id, $name, $characts){
        // Set method and action
        $method = 'products';
        $action = 'addProductsFamily';

        // Set data
        $data = array(
            'id' => $id,
            'name' => $name,
            'characts' => $characts,
            'categ_id' => $categ_id
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }


    /**
     * [RO] Actualizeaza pret client, pret vechi, stoc, status si timp procesare (https://github.com/celdotro/marketplace/wiki/Actualizare-pret,-stoc,-status)
     * [EN] Update price, old price, stock, status, processing time (https://github.com/celdotro/marketplace/wiki/Update-price,-old-price,-stock,-status)
     * @param $arrProducts
     *
     * @return mixed
     * @throws \Exception
     */
    public function updateStockAndPrice($arrProducts) {
        // Sanity check
        if(!is_array($arrProducts) || empty($arrProducts)) throw new \Exception('Functia primeste ca parametru un array cu datele fiecarui produs grupate intr-un sub-array');

        // Set method and action
        $method = 'products';
        $action = 'updateStockAndPrice';

        // Set data
        $data = array('products' => json_encode($arrProducts));

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}
