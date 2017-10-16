<?php
namespace celmarket\Email;

use celmarket\Dispatcher;

class EmailCommunication {

    /**
     * [RO] Preia email-urile fara raspuns despre produse (https://github.com/celdotro/marketplace/wiki/Preia-email-urile-despre-produse)
     * [EN] Retrieve all unanswered emails about products (https://github.com/celdotro/marketplace/wiki/Retrieve-products-emails)
     * @param $product_model
     * @return mixed
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

}
