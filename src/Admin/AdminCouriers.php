<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;
use Exception;

class AdminCouriers
{
    /**
     * [RO] Listeaza toti curierii (https://github.com/celdotro/marketplace/wiki/Listare-curieri)
     * [EN] Lists all couriers (https://github.com/celdotro/marketplace/wiki/List-couriers)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCouriers()
    {
        // Set method and action
        $method = 'admininfo';
        $action = 'getCouriers';

        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza toate conturile de curieri (https://github.com/celdotro/marketplace/wiki/Listare-conturi-curieri)
     * [EN] Lists all couriers accounts (https://github.com/celdotro/marketplace/wiki/List-courier-accounts)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccounts()
    {
        // Set method and action
        $method = 'admininfo';
        $action = 'getAccountCouriers';

        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Adauga un cont de curier nou (https://github.com/celdotro/marketplace/wiki/Adaugare-cont-curier)
     * [EN] Adds a new courier account (https://github.com/celdotro/marketplace/wiki/Add-courier-account)
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addAccount($params = array())
    {
        if (empty($params['courier_id']))
            throw new \Exception('ID-ul curierului este obligatoriu');

        if (empty($params['name']))
            throw new \Exception('Numele contului de curier este obligatoriu');

        if (empty($params['awb_format']))
            throw new \Exception('Formatul AWB este obligatoriu');

        // Set method and action
        $method = 'admininfo';
        $action = 'addAccountCourier';

        $data = array(
            'courier_id'    => $params['courier_id'],
            'name'          => $params['name'],
            'awb_format'    => $params['awb_format'],
            'client_id'     => !empty($params['client_id']) ? $params['client_id'] : '',
            'username'      => !empty($params['username']) ? $params['username'] : '',
            'password'      => !empty($params['password']) ? $params['password'] : '',
            'service'       => !empty($params['service']) ? $params['service'] : '',
            'epod'          => !empty($params['epod']) ? TRUE : FALSE
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Editeaza un cont de curier (https://github.com/celdotro/marketplace/wiki/Editare-cont-curier)
     * [EN] Edit a courier account (https://github.com/celdotro/marketplace/wiki/Edit-courier-account)
     * @param int $id
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function editAccount($id, $params = array())
    {
        if (empty($id) || (int) $id <= 0)
            throw new \Exception('ID-ul contului de curier este obligatoriu');

        if (empty($params['courier_id']))
            throw new \Exception('ID-ul curierului este obligatoriu');

        if (empty($params['name']))
            throw new \Exception('Numele contului de curier este obligatoriu');

        if (empty($params['awb_format']))
            throw new \Exception('Formatul AWB este obligatoriu');

        // Set method and action
        $method = 'admininfo';
        $action = 'addAccountCourier';

        $data = array(
            'id'            => $id,
            'courier_id'    => $params['courier_id'],
            'name'          => $params['name'],
            'awb_format'    => $params['awb_format'],
            'client_id'     => !empty($params['client_id']) ? $params['client_id'] : '',
            'username'      => !empty($params['username']) ? $params['username'] : '',
            'password'      => !empty($params['password']) ? $params['password'] : '',
            'service'       => !empty($params['service']) ? $params['service'] : '',
            'epod'          => !empty($params['epod']) ? TRUE : FALSE
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}
