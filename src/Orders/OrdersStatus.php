<?php

namespace celmarket\Orders;

use celmarket\Dispatcher;

class OrdersStatus {

    /**
     * [RO] Anuleaza o anumita comanda. Un motiv valid e necesar. (https://github.com/celdotro/marketplace/wiki/Anularea-comenzii)
     * [EN] Cancel a specific order. A valid reason is necessary. (https://github.com/celdotro/marketplace/wiki/Cancel-Order)
     * @param $cmd
     * @param int $motiv
     * @param string $observatii
     * @return mixed
     * @throws \Exception
     */
    public function cancelOrder($cmd, $motiv = 0, $observatii = ''){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'cancelOrder';

        // Set data
        $data = array('order' => $cmd);

        $observatii = trim($observatii);
        if($observatii != '' && strlen($observatii) > 4) $data['observatii'] = $observatii;
        elseif($motiv != 0) $data['motiv'] = $motiv;
        else throw new \Exception('Specificati un motiv sau o observatie pentru anularea comenzii. Observatia trebuie sa fie formata din cel putin 4 caractere, spatiile de la inceput si sfarsit fiind ignorate');

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Confirma o comanda existenta (https://github.com/celdotro/marketplace/wiki/Confirmare-comanda)
     * [EN] Confirms an existing order (https://github.com/celdotro/marketplace/wiki/Confirm-order)
     * @param $cmd
     * @return mixed
     * @throws \Exception
     */
    public function confirmOrder($cmd){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'confirmOrder';

        // Set data
        $data = array('order' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Listeaza statusurile ce pot fi folosite pentru anularea unei comenzi (https://github.com/celdotro/marketplace/wiki/Listare-statusuri-anulare)
     * [EN] Lists the statuses that can be used for cancelling an order (https://github.com/celdotro/marketplace/wiki/List-order-cancelling-statuses)
     * @return mixed
     */
    public function listCancellingStatuses(){
        // Set method and action
        $method = 'orders';
        $action = 'listCancellingStatuses';

        // Set data
        $data = array('dummy' => true);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Reactiveaza o comanda anulata (https://github.com/celdotro/marketplace/wiki/Reactiveaza-comanda)
     * [EN] Reactivates a cancelled order (https://github.com/celdotro/marketplace/wiki/Reactivate-order)
     * @param $cmd
     * @return mixed
     * @throws \Exception
     */
    public function reactivateOrder($cmd){
        // Sanity check
        if(!isset($cmd) || !is_int($cmd)) throw new \Exception('Specificati comanda');

        // Set method and action
        $method = 'orders';
        $action = 'reactivateOrder';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    public function getOrderStatusList(){
        // Set method and action
        $method = 'orders';
        $action = 'getOrderStatusList';

        // Set data
        $data = array();

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

}