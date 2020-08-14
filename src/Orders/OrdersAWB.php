<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;
use Exception;

class OrdersAWB
{
    /**
     * [RO] Seteaza un AWB pentru o comanda (https://github.com/celdotro/marketplace/wiki/Creare-AWB)
     * [EN] Add an AWB for a specific order (https://github.com/celdotro/marketplace/wiki/AWB-Import)
     * @param int $orders_id
     * @param int $courier_id
     * @param string $awb_number
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setAwb($orders_id, $courier_id, $awb_number)
    {
        if (empty($orders_id) || !is_int($orders_id))
            throw new \Exception('Specificati ID-ul comenzii');

        if (empty($courier_id) || !is_int($courier_id))
            throw new \Exception('Specificati ID-ul curierului');

        if (empty($awb_number))
            throw new \Exception('Specificati numarul AWB');

        // Set method and action
        $method = 'orders';
        $action = 'generateAwb';
        // Set data
        $data = array(
            'manual'        => TRUE,
            'orders_id'     => $orders_id,
            'courier_id'    => $courier_id,
            'awb_number'    => $awb_number
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Generare AWB (https://github.com/celdotro/marketplace/wiki/Generare-AWB)
     * [EN] Generate AWB (https://github.com/celdotro/marketplace/wiki/Generate-AWB)
     * @param array $awbData
     * @param array $awbSender
     * @param array $awbReceiver
     * @param array $awbOptions
     * @return mixed
     * @throws \Exception
     */
    public function generateAwb($awbData, $awbSender, $awbReceiver = array(), $awbOptions = array())
    {
        // Check AWB Data
        if (empty($awbData['orders_id']))
            throw new Exception('ID-ul comenzii este obligatoriu');

        if (empty($awbData['courier_account']))
            throw new Exception('Contul de curier este obligatoriu');

        if (!isset($awbData['envelopes']))
            throw new Exception('Numarul de plicuri este obligatoriu');

        if (!isset($awbData['packages']))
            throw new Exception('Numarul de pachete este obligatoriu');

        if (empty($awbData['weight']))
            throw new Exception('Greutatea nu este valida');

        // Check AWB Sender
        if (empty($awbSender['address_id']))
            throw new Exception('ID-ul adresei este obligatoriu');

        if (empty($awbSender['contact_id']))
            throw new Exception('ID-ul persoanei de contact este obligatoriu');

        // Check AWB Receiver
        if (!empty($awbReceiver)) {
            if (!empty($awbReceiver['company']) && empty($awbReceiver['name']))
                throw new Exception('Numele companiei este obligatoriu');

            if (empty($awbReceiver['contact']))
                throw new Exception('Persoana de contact destinatar este obligatorie');

            if (empty($awbReceiver['phone']))
                throw new Exception('Telefonul destinatarului este obligatoriu');

            if (empty($awbReceiver['county']))
                throw new Exception('Judetul destinatarului este obligatoriu');

            if (empty($awbReceiver['city']))
                throw new Exception('Orasul destinatarului este obligatoriu');

            if (empty($awbReceiver['address']))
                throw new Exception('Adresa destinatarului este obligatorie');
        }

        // Set method and action
        $method = 'orders';
        $action = 'generateAwb';

        // Set data
        $data = array(
            'orders_id'         => $awbData['orders_id'],
            'courier_account'   => $awbData['courier_account'],
            'sender'            => array(
                'contact_id'        => $awbSender['contact_id'],
                'address_id'        => $awbSender['address_id']
            ),
            'envelopes'         => $awbData['envelopes'],
            'packages'          => $awbData['packages'],
            'weight'            => !empty($awbData['weight']) ? floatval($awbData['weight']) : 1,
            'repayment'         => !empty($awbData['repayment']) ? floatval($awbData['repayment']) : 0,
            'insurance'         => !empty($awbData['insurance']) ? floatval($awbData['insurance']) : 0,
            'awb_format'        => !empty($awbData['awb_format']) ? $awbData['awb_format'] : '',
            'service'           => !empty($awbData['service']) ? $awbData['service'] : '',
            'comments'          => !empty($awbData['comments']) ? $awbData['comments'] : '',
            'options'           => array(
                'open_package'      => !empty($awbOptions['open_package']) ? TRUE : FALSE,
                'saturday_delivery' => !empty($awbOptions['saturday_delivery']) ? TRUE : FALSE,
                'epod'              => !empty($awbOptions['epod']) ? TRUE : FALSE,
            )
        );

        // Set AWB Receiver
        if (!empty($awbReceiver)) {
            $data['receiver'] = array(
                'company'           => !empty($awbReceiver['company']) ? TRUE : FALSE,
                'name'              => !empty($awbReceiver['company']) ? $awbReceiver['name'] : $awbReceiver['contact'],
                'contact'           => $awbReceiver['contact'],
                'phone'             => $awbReceiver['phone'],
                'county'            => $awbReceiver['county'],
                'city'              => $awbReceiver['city'],
                'address'           => $awbReceiver['address']
            );
        }

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza toate AWB-urile unei comenzi (https://github.com/celdotro/marketplace/wiki/Listare-AWB)
     * [EN] Lists all order AWBs (https://github.com/celdotro/marketplace/wiki/List-AWBs)
     * @param int $orders_id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAwbs($orders_id)
    {
        // Set method and action
        $method = 'orders';
        $action = 'getOrderAwbs';

        $data = array('orders_id' => $orders_id);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Printeaza un AWB (https://github.com/celdotro/marketplace/wiki/Printare-AWB)
     * [EN] Print an AWB (https://github.com/celdotro/marketplace/wiki/AWB-Print)
     * @param string $awb_id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function printAwb($awb_id)
    {
        // Set method and action
        $method = 'orders';
        $action = 'downloadAwb';

        $data = array('awb_id' => $awb_id);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}
