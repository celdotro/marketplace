<?php
namespace celmarket\Email;

use celmarket\Dispatcher;

class EmailCommunication {

    /**
     * [RO] Preia email-urile fara raspuns despre produse (https://github.com/celdotro/marketplace/wiki/Preia-email-urile-despre-produse)
     * [EN] Retrieve all unanswered emails about products (https://github.com/celdotro/marketplace/wiki/Retrieve-products-emails)
     * @param $product_model
     * @return mixed
     * @throws \Exception
     */
    public function getProductEmails($product_model){
        // Set method and action
        $method = 'email';
        $action = 'GetProductEmails';

        // Set data
        if(empty($product_model)) $data = array();
        else $data = array('product_model' => $product_model);

        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Trimite un raspuns catre email-ul unui client referitor la un anumit produs (https://github.com/celdotro/marketplace/wiki/Raspunde-email-ului-unui-produs)
     * [EN] Answer a specific email for a product (https://github.com/celdotro/marketplace/wiki/Answer-a-specific-email-for-a-product)
     * @param $questionID
     * @param $answer
     * @return mixed
     * @throws \Exception
     */
    public function answerProductEmail($questionID, $answer){
        // Sanity check
        if(empty($questionID)) throw new \Exception('Specificati un ID valid al intrebarii');
        if(empty($answer) || strlen(trim($answer)) < 10) throw new \Exception('Specificati un raspuns valid mai mare de 10 caractere diferite de spatiu');

        // Set method and action
        $method = 'email';
        $action = 'AnswerProductEmail';

        // Set data
        $data = array('questionID' => $questionID, 'answer' => $answer);

        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia cererile de service aferente afiliatului (https://github.com/celdotro/marketplace/wiki/Preia-cererile-de-retur)
     * [EN] Get service requests for the current affiliate (https://github.com/celdotro/marketplace/wiki/Get-return-requests)
     * @param null $minDate
     * @param null $maxDate
     * @param null $product_model
     * @param null $start
     * @return mixed
     * @throws \Exception
     */
    public function getServiceRequests($minDate = null, $maxDate = null, $product_model = null, $start = null){
        // Set method and action
        $method = 'email';
        $action = 'GetServiceRequests';

        // Set data
        $data = array('dummy' => 1);
        if (!is_null($minDate)) $data['minDate'] = $minDate;
        if (!is_null($maxDate)) $data['maxDate'] = $maxDate;
        if (!is_null($product_model)) $data['product_model'] = $product_model;
        if (!is_null($start)) $data['start'] = $start;

        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Raspunde unei cereri de service (https://github.com/celdotro/marketplace/wiki/Raspunde-unei-cereri-de-service)
     * [EN] Send an answer to a service request (https://github.com/celdotro/marketplace/wiki/Answer-service-request)
     * @param $id
     * @param $answer
     * @return mixed
     * @throws \Exception
     */
    public function answerServiceRequest($id, $answer){
        // Set method and action
        $method = 'email';
        $action = 'AnswerServiceRequest';

        // Set data
        $data = array(
            'id' => $id,
            'answer' => $answer
        );

        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia cererile de retur aferente afiliatului (https://github.com/celdotro/marketplace/wiki/Preia-cererile-de-retur)
     * [EN] Get return requests for the current affilaite (https://github.com/celdotro/marketplace/wiki/Get-return-requests)
     * @param null $minDate
     * @param null $maxDate
     * @param null $product_model
     * @param null $start
     * @return mixed
     * @throws \Exception
     */
    public function getReturnRequests($minDate = null, $maxDate = null, $product_model = null, $start = null){
        // Set method and action
        $method = 'email';
        $action = 'GetReturnRequests';

        // Set data
        $data = array('dummy' => 1);
        if (!is_null($minDate)) $data['minDate'] = $minDate;
        if (!is_null($maxDate)) $data['maxDate'] = $maxDate;
        if (!is_null($product_model)) $data['product_model'] = $product_model;
        if (!is_null($start)) $data['start'] = $start;

        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Raspunde unei cereri de retur (https://github.com/celdotro/marketplace/wiki/Raspunde-cererii-de-retur)
     * [EN] Send an answer to a return request (https://github.com/celdotro/marketplace/wiki/Retrieve-service-requests)
     * @param $id
     * @param $answer
     * @param null $images
     * @return mixed
     * @throws \Exception
     */
    public function answerReturnRequests($id, $answer, $images = null){
        // Set method and action
        $method = 'email';
        $action = 'AnswerReturnRequests';

        // Set data
        $data = array(
            'id' => $id,
            'answer' => $answer
        );

        $result = Dispatcher::send($method, $action, $data, $images);

        return $result;
    }
}
