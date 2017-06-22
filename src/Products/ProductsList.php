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
     * [RO] Listeaza produsele. Lista poate fi scurtata folosind o valoare de start si o limita. De asemenea, produsele
     * pot fi filtrate in functie de nume. (https://github.com/celdotro/marketplace/wiki/Listeaza-produse)
     * [EN] Lists products. The list can be shrunk using a start and limit value. Also, the products can be filtered
     * based on their name. (https://github.com/celdotro/marketplace/wiki/List-products)
     * @param $start
     * @param $limit
     * @param null $search
     * @param bool $forceCount
     * @throws \Exception
     */
    public function listProducts($start, $limit, $search = null, $forceCount = false){
        // Sanity check
        if(!isset($start) || !is_int($start) || $start < 0) throw new \Exception('Precizati o valoare de start numar natural');
        if(!isset($limit) || !is_int($limit) || $limit < 0) throw new \Exception('Precizati un numar natural pentru limita');

        // Set method and action
        $method = 'products';
        $action = 'readProducts';

        // Set data
        $data = array('start' => $start, 'limit' => $limit, 'forceCount' => $forceCount);
        if(!is_null($search)) $data['search'] = $search;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}
