<?php

namespace celmarket\Email;

use celmarket\Dispatcher;

class EmailOrder
{

    /**
     * [RO] Returneaza o lista cu ID-uri si denumirea mesajelor predefinite pentru anumite actiuni legate de comanda (https://github.com/celdotro/marketplace/wiki/Listare-email-uri-predefinite-pentru-comenzi)
     * [EN] Returns a list of IDs and names of predefined emails for actions related to an order (https://github.com/celdotro/marketplace/wiki/Get-client-emails-for-an-order)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOrderEmailList()
    {
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getClientEmailsForOrder($cmd)
    {
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendOrderEmail($cmd, $idEmail)
    {
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
     * @param array @attachments
     * @param null @emailTest
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendOrderCustomEmail($cmd, $subject, $body, $replyID = null, $attachments = array(), $emailTest = null)
    {
        // Sanity check
        if (is_null($cmd) || !is_numeric($cmd)) throw new \Exception('Specificati o comanda valida');
        if (is_null($subject) || $subject == '') throw new \Exception('Specificati un subiect valid');
        if (is_null($body) || $body == '') throw new \Exception('Specificati un continut valid');

        // Set method and action
        $method = 'email';
        $action = 'sendOrderCustomEmail';

        // Set data
        $data = array('cmd' => $cmd, 'subject' => $subject, 'body' => $body);
        if (!is_null($replyID)) $data['replyID'] = $replyID;
        if (!is_null($emailTest)) $data['emailTest'] = $emailTest;

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data, $attachments);

        return $result;
    }

    /**
     * [RO] Trimite notificare de stergere a AWB-ului (https://github.com/celdotro/marketplace/wiki/Trimite-notificare-de-stergere-a-AWB-ului)
     * [EN] Send AWB removal notification (https://github.com/celdotro/marketplace/wiki/Send-notification-for-AWB-removal)
     * @param $orders_id
     * @param $reason
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function notifyAWBRemoval($orders_id, $reason)
    {
        // Sanity check
        if (empty($orders_id) || !is_numeric($orders_id)) throw new \Exception('Specificati o comanda valida');
        if (empty($reason)) throw new \Exception('Specificati un motiv valid');

        // Set method and action
        $method = 'email';
        $action = 'notifyAWBRemoval';

        // Set data
        $data = array(
            'orders_id' => $orders_id,
            'reason' => $reason
        );

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function notifyInvoiceRemoval($orders_id, $reason)
    {
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

    /**
     * [RO] Descarca un atasament aferent email-ului unei comenzi si informatii relevante despre acesta (https://github.com/celdotro/marketplace/wiki/Descarca-atasamentul-email-ului-comenzii)
     * [EN] Downloads an attachment belonging to an order's email and other relevant information regarding the attachment (https://github.com/celdotro/marketplace/wiki/Download-order-email-attachment)
     * @param $emailID
     * @param $attachmentNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function downloadOrderEmailAttachment($emailID, $attachmentNumber)
    {
        // Sanity check
        if (empty($emailID) || !is_numeric($emailID)) throw new \Exception('Specificati o comanda valida');
        if (empty($attachmentNumber) || !is_numeric($attachmentNumber)) throw new \Exception('Speciificati un numar de atasament valid');

        // Set method and action
        $method = 'email';
        $action = 'downloadOrderEmailAttachment';

        // Set data
        $data = array(
            'emailID' => $emailID,
            'attachmentNumber' => $attachmentNumber
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia mesajele comenzilor (https://github.com/celdotro/marketplace/wiki/Preia-mesajele-comenzilor)
     * [EN] Retrieves orders messages (https://github.com/celdotro/marketplace/wiki/Get-orders-messages)
     * @param null $minDate
     * @param null $maxDate
     * @param null $email
     * @param null $name
     * @param null $site
     * @param null $raspuns
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOrdersContacts($minDate = null, $maxDate = null, $email = null, $name = null, $site = null, $raspuns = null)
    {
        // Set method and action
        $method = 'email';
        $action = 'getOrdersContacts';

        // Set data
        $data = array(
            'minDate' => $minDate,
            'maxDate' => $maxDate,
            'email' => $email,
            'name' => $name,
            'site' => $site,
            'raspuns' => $raspuns
        );

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia numarul de mesaje fara raspuns (https://github.com/celdotro/marketplace/wiki/Preia-numarul-de-mesaje-fara-raspuns-ale-comenzilor)
     * [EN] Get unanswered orders messages (https://github.com/celdotro/marketplace/wiki/Get-unanswered-orders-message-number)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUnansweredOrderContact()
    {
        // Set method and action
        $method = 'email';
        $action = 'getUnansweredOrderContact';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array('dummy' => 1));

        return $result;
    }
}

