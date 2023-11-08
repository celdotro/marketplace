<?php

namespace celmarket\Invoices;

use celmarket\Dispatcher;

class InvoicesData
{
    /**
     * DEPRECATED
     * [RO] Sterge factura unei facturi (https://github.com/celdotro/marketplace/wiki/Stergere-factura)
     * [EN] Deletes an order's invoice (https://github.com/celdotro/marketplace/wiki/Remove-Invoice)
     * @param $ordersID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeInvoiceOld($ordersID)
    {
        // Sanity check
        if(!isset($ordersID) || !is_int($ordersID)) {
            throw new \Exception('Specificati comanda');
        }

        // Set method and action
        $method = 'orders';
        $action = 'removeInvoice';

        // Set data
        $data = array('orders_id' => $ordersID);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Sterge factura unei facturi (https://github.com/celdotro/marketplace/wiki/Stergere-factura)
     * [EN] Deletes an order's invoice (https://github.com/celdotro/marketplace/wiki/Remove-Invoice)
     * @param $ordersID
     * @param $series
     * @param $number
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeInvoice($ordersID, $series, $number)
    {
        // Sanity check
        if(!isset($ordersID) || !is_int($ordersID)) {
            throw new \Exception('Specificati comanda');
        }
        if(!isset($series)) {
            throw new \Exception('Specificati seria facturii');
        }
        if(!isset($number)) {
            throw new \Exception('Specificati numarul facturii');
        }

        // Set method and action
        $method = 'orders';
        $action = 'deleteOrderInvoice';

        // Set data
        $data = array('orders_id' => $ordersID, 'series' => $series, 'number' => $number);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * DEPRECATED
     * [RO] Genereaza o noua factura (https://github.com/celdotro/marketplace/wiki/Adaugare-factura)
     * [EN] Generates a new invoice (https://github.com/celdotro/marketplace/wiki/Add-invoice)
     * @param $cmd
     * @param $serie
     * @param $nr_fact
     * @return mixed
     * @throws \Exception
     */
    public function importInvoiceOld($cmd, $serie, $nr_fact)
    {
        // Sanity check
        if(empty($cmd) || !is_int($cmd)) {
            throw new \Exception('Specificati comanda');
        }
        if(empty($serie)) {
            throw new \Exception('Specificati seria facturii');
        }
        if(empty($nr_fact)) {
            throw new \Exception('Specificati numarul  facturii');
        }

        // Set method and action
        $method = 'orders';
        $action = 'importInvoice';

        // Set data
        $data = array(
            'orders_id' => $cmd,
            'serie' => $serie,
            'nr_fact' => $nr_fact
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
    * [RO] Ataseaza o factura (https://github.com/celdotro/marketplace/wiki/Adaugare-factura)
    * [EN] Attach an invoice (https://github.com/celdotro/marketplace/wiki/Add-invoice)
    * @param $cmd
    * @param $serie
    * @param $nr_fact
    * @return mixed
    * @throws \Exception
    */
    public function importInvoice($cmd, $series = '', $number = '', $providerId = 0, $file = null)
    {
        // Sanity check
        if(empty($cmd) || !is_int($cmd)) {
            throw new \Exception('Specificati comanda');
        }

        if(empty($providerId)) {
            if(empty($series)) {
                throw new \Exception('Specificati seria facturii');
            }
            if(empty($number)) {
                throw new \Exception('Specificati numarul facturii');
            }
            if(empty($file)) {
                throw new \Exception('Specificati calea catre fisierul cu factura');
            }
            if(!file_exists($file)) {
                throw new \Exception('Fisierul nu exista');
            }
        }

        // Set method and action
        $method = 'orders';
        $action = 'addOrderInvoice';

        // Set data
        $data = array(
            'oid' => $cmd,
            'series' => $series,
            'number' => $number,
            'providerId' => $providerId,
        );

        $files = [
          'file' =>  file_get_contents($file)
        ];

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data, $files);

        return $result;
    }

    /**
     * [RO] Listeaza facturile atasate unei comenzi (https://github.com/celdotro/marketplace/wiki/Listeaza-facturi)
     * [EN] List attached invoices for an order (https://github.com/celdotro/marketplace/wiki/List-invoices)
     * @param $cmd
     * @return mixed
     * @throws \Exception
     */
    public function getOrderInvoices($cmd)
    {
        // Sanity check
        if(empty($cmd) || !is_int($cmd)) {
            throw new \Exception('Specificati comanda');
        }

        // Set method and action
        $method = 'orders';
        $action = 'getOrderInvoices';

        // Set data
        $data = array(
            'orders_id' => $cmd,
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}
