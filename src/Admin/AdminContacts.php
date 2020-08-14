<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;
use Exception;

class AdminContacts
{
    /**
     * [RO] Adauga o persoana de contact noua (https://github.com/celdotro/marketplace/wiki/Adaugare-persoana-de-contact)
     * [EN] Adds a new contact person (https://github.com/celdotro/marketplace/wiki/Add-contact-person)
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addContact($params = array())
    {
        if (empty($params['type']))
            throw new \Exception('Tipul contactului este obligatoriu');

        if (empty($params['name']))
            throw new \Exception('Numele este obligatoriu');

        if (empty($params['email']) || filter_var($params['email'], FILTER_VALIDATE_EMAIL) === FALSE)
            throw new \Exception('Adresa de email nu este corecta');

        if (empty($params['phone']))
            throw new \Exception('Numarul de telefon este obligatoriu');

        if (!isset($params['status']))
            throw new \Exception('Statusul este obligatoriu');

        // Set method and action
        $method = 'admininfo';
        $action = 'saveAfiliateContact';

        $data = array(
            'type'      => $params['type'],
            'name'      => $params['name'],
            'email'     => $params['email'],
            'phone'     => $params['phone'],
            'status'    => intval($params['status'])
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Editeaza o persoana de contact (https://github.com/celdotro/marketplace/wiki/Editare-persoana-de-contact)
     * [EN] Edit a contact person (https://github.com/celdotro/marketplace/wiki/Edit-contact-person)
     * @param int $id
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function editContact($id = null, $params = array())
    {
        if (empty($id))
            throw new \Exception('ID-ul contactului este obligatoriu');

        if (empty($params['type']))
            throw new \Exception('Tipul contactului este obligatoriu');

        if (empty($params['name']))
            throw new \Exception('Numele este obligatoriu');

        if (empty($params['email']) || filter_var($params['email'], FILTER_VALIDATE_EMAIL) === FALSE)
            throw new \Exception('Adresa de email nu este corecta');

        if (empty($params['phone']))
            throw new \Exception('Numarul de telefon este obligatoriu');

        if (!isset($params['status']))
            throw new \Exception('Statusul este obligatoriu');

        // Set method and action
        $method = 'admininfo';
        $action = 'saveAfiliateContact';

        $data = array(
            'id'        => $id,
            'type'      => $params['type'],
            'name'      => $params['name'],
            'email'     => $params['email'],
            'phone'     => $params['phone'],
            'status'    => intval($params['status'])
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza toate persoanele de contact (https://github.com/celdotro/marketplace/wiki/Listare-persoane-de-contact)
     * [EN] Lists all contact persons (https://github.com/celdotro/marketplace/wiki/List-contact-persons)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getContacts()
    {
        // Set method and action
        $method = 'admininfo';
        $action = 'getAffiliateContacts';

        $data = array('dummy' => 1);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}
