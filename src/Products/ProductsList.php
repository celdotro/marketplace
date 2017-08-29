<?php

namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsList
{
    /**
     * [RO] Returneaza toate categoriile (https://github.com/celdotro/marketplace/wiki/Listeaza-categorii)
     * [EN] Get all categories (https://github.com/celdotro/marketplace/wiki/List-categories)
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCategories()
    {
        // Set method and action
        $method = 'import';
        $action = 'getSupplierCategories';

        // Set data
        $data = array();

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza produsele. Lista este scurtata folosind o valoare de start si o limita. De asemenea, produsele
     * pot fi filtrate. (https://github.com/celdotro/marketplace/wiki/Listeaza-produse)
     * [EN] Lists products. The list is shrunk using a start and limit value. Also, the products can be filtered. (https://github.com/celdotro/marketplace/wiki/List-products)
     * @param $start
     * @param $limit
     * @param null $search
     * @param bool $forceCount
     * @param null $filters
     * @return mixed
     * @throws \Exception
     */
    public function listProducts($start, $limit, $search = null, $forceCount = false, $filters = null){
        // Sanity check
        if(!isset($start) || !is_int($start) || $start < 0) throw new \Exception('Precizati o valoare de start numar natural');
        if(!isset($limit) || !is_int($limit) || $limit < 0) throw new \Exception('Precizati un numar natural pentru limita');

        // Set method and action
        $method = 'products';
        $action = 'readProducts';

        // Set data
        $data = array('start' => $start, 'limit' => $limit, 'forceCount' => $forceCount);
        if(!is_null($search)) $data['search'] = $search;
        if(!is_null($filters)) $data['filters'] = $filters;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza caracteristicile unei categorii (https://github.com/celdotro/marketplace/wiki/Listeaza-caracteristicile-unei-categorii)
     * [EN] Lists the characteristics of a category (https://github.com/celdotro/marketplace/wiki/List-characteristics-of-a-category)
     * @param $categID
     * @return mixed
     * @throws \Exception
     */
    public function getCategoryCharacteristics($categID){
        // Sanity check
        if(!isset($categID) || !is_int($categID) || $categID < 0) throw new \Exception('Specificati o categorie valida');

        $method = 'products';
        $action = 'getCategoryCharacteristics';

        // Set data
        $data = array('categ_id' => $categID);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}
