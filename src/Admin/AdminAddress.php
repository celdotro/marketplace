<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminAddress {

    /**
     * [RO] Adauga o adresa pentru ridicarea coletelor de catre curieri (https://github.com/celdotro/marketplace_examples/blob/master/Admin/4.addAddress.php)
     * [EN] Adds a new pick-up address that will be sent to couriers (https://github.com/celdotro/marketplace_examples/blob/master/Admin/4.addAddress.php)
     * @param null $address
     * @param null $id_curier
     * @param array $accData
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addAddress($address = null, $id_curier = null, $accData = array()){
        // Sanity check
        if(is_null($address) || $address === '') throw new \Exception('Specificati o adresa valida');

        // Set method and action
        $method = 'admininfo';
        $action = 'editAddress';

        // Set data
        $data = array(
            'address' => $address,
            'accData' => $accData
        );
        if(!is_null($id_curier)) $data['courier'] = $id_curier;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Actualizeaza adresa unui punct de ridicare pentru curieri (https://github.com/celdotro/marketplace_examples/blob/master/Admin/5.editAddress.php)
     * [EN] Updates address information of a pick-up point (https://github.com/celdotro/marketplace_examples/blob/master/Admin/5.editAddress.php)
     * @param null $id
     * @param null $address
     * @param $courier
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function editAddress($id = null, $address = null, $courier){
        // Sanity check
        if(is_null($address) || $address === '') throw new \Exception('Specificati o adresa valida');
        if(is_null($id) || !is_numeric($id)) throw new \Exception('Specificati un ID valid');

        // Set method and action
        $method = 'admininfo';
        $action = 'editAddress';

        // Set data
        $data = array('id' => $id, 'address' => $address, 'courier' => $courier);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza toate adresele punctelor de ridicare pentru curieri (https://github.com/celdotro/marketplace_examples/blob/master/Admin/6.listAddresses.php)
     * [EN] Lists all pick-up points addresses (https://github.com/celdotro/marketplace_examples/blob/master/Admin/6.listAddresses.php)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listAddresses(){
        // Set method and action
        $method = 'admininfo';
        $action = 'listAddresses';

        // Set data
        $data = array('param' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Stergerea adresei unui punct de ridicare pentru curieri (https://github.com/celdotro/marketplace_examples/blob/master/Admin/7.deleteAddress.php)
     * [EN] Delete a pick-up point's address (https://github.com/celdotro/marketplace_examples/blob/master/Admin/7.deleteAddress.php)
     * @param null $id
     * @param null $address
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteAddress($id = null, $address = null){
        // Sanity check
        if(is_null($id) || !is_numeric($id)) throw new \Exception('Specificati un ID valid');

        // Set method and action
        $method = 'admininfo';
        $action = 'deleteAddress';

        // Set data
        $data = array('id' => $id);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Trimite email pentru adaugarea unui nou curier (https://github.com/celdotro/marketplace/wiki/Adauga-curier)
     * [EN] Sends an email with a request to add a new courier (https://github.com/celdotro/marketplace/wiki/Add-courier)
     * @param $name
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addCourier($name){
        // Set method and action
        $method = 'admininfo';
        $action = 'addCourier';

        // Set data
        $data = array('name' => $name);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}