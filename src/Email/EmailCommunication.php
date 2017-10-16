<?php
namespace celmarket\Email;

use celmarket\Dispatcher;

class EmailCommunication {

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
