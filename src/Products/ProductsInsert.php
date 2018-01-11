<?php

namespace celmarket\Products;

use celmarket\Dispatcher;


class ProductsInsert {

    /**
     * [RO] Insereaza/Actualizeaza un array de produse. Fiecare produs are un array de date relevante. (https://github.com/celdotro/marketplace/wiki/Import-produse)
     * [EN] Insert/Update an array of products. Each product has an array of relevant data. (https://github.com/celdotro/marketplace/wiki/Import-products)
     * @param array $arrProducts
     * @return mixed
     * @throws \Exception
     */
    public function importProducts ($arrProducts = array()) {
        // Sanity check - for older versions of PHP
        if (!is_array($arrProducts)) throw new \Exception('Functia primeste ca parametru un array cu datele fiecarui produs grupate intr-un sub-array');

        // Set method and action
        $method = 'import';
        $action = 'importer';

        // Set data
        $data = array('products' => $arrProducts);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Adauga noi valori in lista unei caracteristici (https://github.com/celdotro/marketplace/wiki/Adauga-noi-valori-unei-caracteristici)
     * [EN] Add new values to a characteristic's list (https://github.com/celdotro/marketplace/wiki/Add-new-values-to-a-characteristic)
     * @param $categID
     * @param $charactID
     * @param $charactValues
     * @return mixed
     * @throws \Exception
     */
    public function addValuesToCharacteristic ($categID, $charactID, $charactValues) {
        // Sanity check - for older versions of PHP
        if (!isset($categID)) throw new \Exception('Specificati categoria');
        if (!isset($charactID)) throw new \Exception('Specificati ID-ul caracteristicii');
        if (!isset($charactValues) || empty($charactValues)) throw new \Exception('Specificati valorile caracteristicii');

        // Set method and action
        $method = 'products';
        $action = 'addValuesToCharacteristic';

        // Set data
        $data = array(
            'categID' => $categID,
            'charactID' => $charactID,
            'charactValues' => $charactValues
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Adauga o noua oferta unui produs existent (https://github.com/celdotro/marketplace/wiki/Adauga-o-noua-oferta-unui-produs-existent)
     * [EN] Add another offer to an existing product (https://github.com/celdotro/marketplace/wiki/Add-offer-to-existing-product)
     * @param $products_model
     * @param $stoc
     * @param $pret
     * @param $overridePrice
     * @return mixed
     * @throws \Exception
     */
    public function addOfferToExistingProduct($products_model, $stoc, $pret, $overridePrice){
        // Sanity check - for older versions of PHP
        if (!isset($products_model)) throw new \Exception('Specificati un model de produs');
        if (!isset($stoc)) throw new \Exception('Specificati stocul');
        if (!isset($pret)) throw new \Exception('Specificati pretul');

        // Set method and action
        $method = 'products';
        $action = 'addOfferToExistingProduct';

        // Set data
        $data = array(
            'products_model' => $products_model,
            'stoc' => $stoc,
            'pret' => $pret,
            'overridePrice' => $overridePrice
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}