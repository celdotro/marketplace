<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;
use Exception;

class AdminAddresses
{
    /**
     * [RO] Adauga o adresa noua (https://github.com/celdotro/marketplace/wiki/Adaugare-adresa)
     * [EN] Adds a new address (https://github.com/celdotro/marketplace/wiki/Add-address)
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addAddress($params = array())
    {
        if (empty($params['type']))
            throw new \Exception('Tipul adresei este obligatoriu');

        if (empty($params['county']))
            throw new \Exception('Judetul este obligatoriu');

        if (empty($params['city']))
            throw new \Exception('Orasul este obligatoriu');

        if (empty($params['address']))
            throw new \Exception('Adresa este obligatorie');

        if (!isset($params['status']))
            throw new \Exception('Statusul este obligatoriu');

        // Set method and action
        $method = 'admininfo';
        $action = 'saveAffiliateAddress';

        $data = array(
            'type'      => $params['type'],
            'county'    => $params['county'],
            'city'      => $params['city'],
            'address'   => $params['address'],
            'zip'       => !empty($params['zipcode']) ? $params['zipcode'] : '',
            'status'    => $params['status']
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Editeaza o adresa (https://github.com/celdotro/marketplace/wiki/Editare-adresa)
     * [EN] Updates address (https://github.com/celdotro/marketplace/wiki/Edit-address)
     * @param int $id
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function editAddress($id = null, $params = array())
    {
        if (empty($id))
            throw new \Exception('ID-ul adresei este obligatoriu');

        if (empty($params['type']))
            throw new \Exception('Tipul adresei este obligatoriu');

        if (empty($params['county']))
            throw new \Exception('Judetul este obligatoriu');

        if (empty($params['city']))
            throw new \Exception('Orasul este obligatoriu');

        if (empty($params['address']))
            throw new \Exception('Adresa este obligatorie');

        if (!isset($params['status']))
            throw new \Exception('Statusul este obligatoriu');

        // Set method and action
        $method = 'admininfo';
        $action = 'saveAffiliateAddress';

        $data = array(
            'address_id'    => $id,
            'type'          => $params['type'],
            'county'        => $params['county'],
            'city'          => $params['city'],
            'address'       => $params['address'],
            'zip'           => !empty($params['zipcode']) ? $params['zipcode'] : '',
            'status'        => !empty($params['status']) ? TRUE : FALSE
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza toate adresele (https://github.com/celdotro/marketplace/wiki/Listare-adrese)
     * [EN] Lists all addresses (https://github.com/celdotro/marketplace/wiki/List-addresses)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAddresses()
    {
        // Set method and action
        $method = 'admininfo';
        $action = 'getAffiliateAddresses';

        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza toate judetele (https://github.com/celdotro/marketplace/wiki/Listare-judete)
     * [EN] Lists all counties (https://github.com/celdotro/marketplace/wiki/List-counties)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCountiesList()
    {
        // Set method and action
        $method = 'admininfo';
        $action = 'getCountiesList';

        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza toate orasele dintr-un judet (https://github.com/celdotro/marketplace/wiki/Listeaza-orase)
     * [EN] Lists all cities from a specific county (https://github.com/celdotro/marketplace/wiki/List-cities)
     * @param string $county
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCitiesList($county)
    {
        if (empty($county))
            throw new Exception('Judetul este obligatoriu');

        // Set method and action
        $method = 'admininfo';
        $action = 'getCitiesList';

        $data = array(
            'county'    => $county
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}
