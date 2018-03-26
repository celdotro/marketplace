<?php
namespace celmarket\Email;

use celmarket\Dispatcher;

class EmailOrder {

    /**
     * [RO] Returneaza o lista cu ID-uri si denumirea mesajelor predefinite pentru anumite actiuni legate de comanda (https://github.com/celdotro/marketplace/wiki/Listare-email-uri-predefinite-pentru-comenzi)
     * [EN] Returns a list of IDs and names of predefined emails for actions related to an order (https://github.com/celdotro/marketplace/wiki/Get-client-emails-for-an-order)
     * @return mixed
     */
    public function getOrderEmailList(){
        // Set method and action
        $method = 'email';
        $action = 'getOrderEmailList';

        // Set data
        $data = array('params' => true);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Returneaza un graf cu conversatiile purtate prin intermediul email-ului cu clientii (https://github.com/celdotro/marketplace/wiki/Preia-email-urile-unui-client-pentru-o-comanda)
     * [EN] Returns a graph with the conversations made through the email with the client (https://github.com/celdotro/marketplace/wiki/Get-client-emails-for-an-order)
     * @param $cmd
     * @return mixed
     * @throws \Exception
     */
    public function getClientEmailsForOrder($cmd){
        // Sanity check
        if (is_null($cmd) || !is_numeric($cmd)) throw new \Exception('Specificati o comanda valida');

        // Set method and action
        $method = 'email';
        $action = 'getClientEmailsForOrder';

        // Set data
        $data = array('cmd' => $cmd);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Trimite clientului un email predefinit aferent unei comenzi (https://github.com/celdotro/marketplace/wiki/Trimitere-email-aferent-comenzii)
     * [EN] Sends the client a predefined email related to an order (https://github.com/celdotro/marketplace/wiki/Send-predefined-order-email)
     * @param $cmd
     * @param $idEmail
     * @return mixed
     * @throws \Exception
     */
    public function sendOrderEmail($cmd, $idEmail){
        // Sanity check
        if (is_null($cmd) || !is_numeric($cmd)) throw new \Exception('Specificati o comanda valida');
        if (is_null($idEmail) || !is_numeric($idEmail)) throw new \Exception('Specificati un ID valid de email');

        // Set method and action
        $method = 'email';
        $action = 'sendOrderEmail';

        // Set data
        $data = array('cmd' => $cmd, 'idEmail' => $idEmail);

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Trimite clientului un email personalizat aferent unei comenzi (https://github.com/celdotro/marketplace/wiki/Trimitere-email-personalizat-aferent-comenzii)
     * [EN] Sends the client a custom email related to an order (https://github.com/celdotro/marketplace/wiki/Send-custom-order-email)
     * @param $cmd
     * @param $subject
     * @param $body
     * @param null $replyID
     * @return mixed
     * @throws \Exception
     */
    public function sendOrderCustomEmail($cmd, $subject, $body, $replyID = null){
        // Sanity check
        if (is_null($cmd) || !is_numeric($cmd)) throw new \Exception('Specificati o comanda valida');
        if (is_null($subject) || $subject == '') throw new \Exception('Specificati un subiect valid');
        if (is_null($body) || $body == '') throw new \Exception('Specificati un continut valid');

        // Set method and action
        $method = 'email';
        $action = 'sendOrderCustomEmail';

        // Set data
        $data = array('cmd' => $cmd, 'subject' => $subject, 'body' => $body);
        if(!is_null($replyID)) $data['replyID'] = $replyID;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Trimite o notificare prin care se doreste eliminarea facturii (https://github.com/celdotro/marketplace/wiki/Notifica-eliminarea-facturii)
     * [EN] Send a notification in order to ask for an invoice to be removed (https://github.com/celdotro/marketplace/wiki/Notify-invoice-removal)
     * @param $orders_id
     * @param $reason
     * @return mixed
     * @throws \Exception
     */
    public function notifyInvoiceRemoval($orders_id, $reason){
        // Sanity check
        if (empty($orders_id) || !is_numeric($orders_id)) throw new \Exception('Specificati o comanda valida');
        if (empty($reason)) throw new \Exception('Specificati un motiv valid');

        // Set method and action
        $method = 'email';
        $action = 'notifyInvoiceRemoval';

        // Set data
        $data = array(
            'orders_id' => $orders_id,
            'reason' => $reason
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }
}