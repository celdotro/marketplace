<?php

namespace celmarket\Products;

use celmarket\Dispatcher;

class ProductsList
{
    /**
     * [RO] Returneaza toate categoriile (https://github.com/celdotro/marketplace/wiki/Listeaza-categorii)
     * [EN] Get all categories (https://github.com/celdotro/marketplace/wiki/List-categories)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * [RO] Listeaza produsele. Lista este scurtata folosind o valoare de start si o limita. De asemenea, produsele pot fi filtrate. (https://github.com/celdotro/marketplace/wiki/Listeaza-produse)
     * [EN] Lists products. The list is shrunk using a start and limit value. Also, the products can be filtered. (https://github.com/celdotro/marketplace/wiki/List-products)
     * @param $start
     * @param $limit
     * @param null $search
     * @param bool $forceCount
     * @param null $filters
     * @param null $includeTransport
     * @param bool $orderByMostViewed
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listProducts($start, $limit, $search = null, $forceCount = false, $filters = null, $includeTransport = null, $orderByMostViewed = false){
        // Sanity check
        if(!isset($start) || !is_int($start) || $start < 0) throw new \Exception('Precizati o valoare de start numar natural');
        if(!isset($limit) || !is_int($limit) || $limit < 0) throw new \Exception('Precizati un numar natural pentru limita');

        // Set method and action
        $method = 'products';
        $action = 'readProducts';

        // Set data
        $data = array('start' => $start, 'limit' => $limit, 'forceCount' => $forceCount, 'orderByMostViewed' => $orderByMostViewed);
        if(!is_null($search)) $data['search'] = $search;
        if(!is_null($filters)) $data['filters'] = $filters;
        if(!is_null($includeTransport)) $data['includeTransport'] = $includeTransport;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza caracteristicile unei categorii (https://github.com/celdotro/marketplace/wiki/Listeaza-caracteristicile-unei-categorii)
     * [EN] Lists the characteristics of a category (https://github.com/celdotro/marketplace/wiki/List-characteristics-of-a-category)
     * @param $categID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
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

    /**
     * [RO] Listeaza filtrele disponibile si datele acestora dupa ce au fost corelate (https://github.com/celdotro/marketplace/wiki/Listeaza-filtre )
     * [EN] List available filters after correlation (https://github.com/celdotro/marketplace/wiki/List-filters)
     * @param null $filters
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listFilters($filters = null){
        $method = 'products';
        $action = 'listFilters';

        // Set data
        $data = array('filters' => $filters);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza caracteristicile obligatorii ale unei categorii (https://github.com/celdotro/marketplace/wiki/Listeaza-caracteristicile-obligatorii-ale-unei-categorii)
     * [EN] Lists the mandatory characteristics of a category (https://github.com/celdotro/marketplace/wiki/List-mandatory-charactersitics-for-a-category)
     * @param $categID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listCategoryMandatoryCharacteristics($categID){
        // Sanity check
        if(!isset($categID) || !is_int($categID) || $categID < 0) throw new \Exception('Specificati o categorie valida');

        $method = 'products';
        $action = 'listCategoryMandatoryCharacteristics';

        // Set data
        $data = array('categ_id' => $categID);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza produsele live dintr-o categorie precizata prin parametru (https://github.com/celdotro/marketplace/wiki/Preluare-produse-live-din-categorie)
     * [EN] List all live products from a category (https://github.com/celdotro/marketplace/wiki/Retrieve-live-products-from-category)
     * @param $category
     * @param null $keyword
     * @param null $start
     * @param null $limit
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLiveProductsFromCategory($category, $keyword = null, $start = null, $limit = null){
        // Sanity check
        if(!isset($category) || !is_int($category) || $category < 0) throw new \Exception('Specificati o categorie valida');

        $method = 'products';
        $action = 'getLiveProductsFromCategory';

        // Set data
        $data = array('category' => $category);
        if(!is_null($keyword)) $data['keyword'] = $keyword;
        if(!is_null($start)) $data['start'] = $start;
        if(!is_null($limit)) $data['limit'] = $limit;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia produsele live pe categorii (https://github.com/celdotro/marketplace/wiki/Preia-produsele-live-pe-categorii)
     * [EN] Get live products for each category (https://github.com/celdotro/marketplace/wiki/Get-live-products-categories)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLiveProductsCategory(){
          $method = 'products';
          $action = 'getLiveProductsCategory';

          // Set data
          $data = array('dummy' => true);

          // Send request and retrieve response
          $result = Dispatcher::send($method, $action, $data);

          return $result;
    }

    /**
     * [RO] Exporta lista de produse in format xlsx (https://github.com/celdotro/marketplace/wiki/Export-produse)
     * [EN] Export products in xlsx format (https://github.com/celdotro/marketplace/wiki/Export-products)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function exportProducts(){
        $method = 'products';
        $action = 'exportProducts';

        // Set data
        $data = array('dummy' => true);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza familiile de produse (https://github.com/celdotro/marketplace/wiki/Listeaza-familiile-de-produse)
     * [EN] List product families (https://github.com/celdotro/marketplace/wiki/List-product-families)
     * @param $start
     * @param $limit
     * @param $search
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getProductsFamilies($start, $limit, $search){
        $method = 'products';
        $action = 'getProductsFamilies';

        // Set data
        $data = array(
            'start' => $start,
            'limit' => $limit,
        );

        if(!empty($search)) $data['search'] = $search;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia datele produselor dintr-o familie (https://github.com/celdotro/marketplace/wiki/Preia-produse-din-familie)
     * [EN] Get product's data for the products that belong to a family (https://github.com/celdotro/marketplace/wiki/Get-product-from-family)
     * @param $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getProductsForFamily($id){
        $method = 'products';
        $action = 'getProductsForFamily';

        // Set data
        $data = array(
            'id' => $id
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia ID-ul unui producator (https://github.com/celdotro/marketplace/wiki/Preia-ID-producator)
     * [EN] Retrieve manufacturer's ID (https://github.com/celdotro/marketplace/wiki/Get-manufacturer-ID)
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function getManufacturerID($name){
        $method = 'products';
        $action = 'getManufacturerID';

        // Set data
        $data = array(
            'name' => $name
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia lista produselor aflate in asteptare (https://github.com/celdotro/marketplace/wiki/Preia-produse-in-asteptare)
     * [EN] Get waiting products list (https://github.com/celdotro/marketplace/wiki/Get-waiting-products)
     * @param $start
     * @return mixed
     * @throws \Exception
     */
    public function getWaitingProducts($start){
        // Sanity check
        if(!isset($start) || !is_int($start) || $start < 0) throw new \Exception('Precizati o valoare de start numar natural');

        // Set method and action
        $method = 'products';
        $action = 'getWaitingProducts';

        // Set data
        $data = array('start' => $start);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia lista produselor respinse (https://github.com/celdotro/marketplace/wiki/Preia-produsele-respinse)
     * [EN] Get rejected products list (https://github.com/celdotro/marketplace/wiki/Get-rejected-products)
     * @param $start
     * @return mixed
     * @throws \Exception
     */
    public function getRejectedProducts($start){
        // Sanity check
        if(!isset($start) || !is_int($start) || $start < 0) throw new \Exception('Precizati o valoare de start numar natural');

        // Set method and action
        $method = 'products';
        $action = 'getRejectedProducts';

        // Set data
        $data = array('start' => $start);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}
