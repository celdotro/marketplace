<?php

namespace celmarket\Admin;

use celmarket\Dispatcher;

class AdminAccount {

    /**
     * [RO] Actualizeaza urmatoarele date aferente afiliatului: CIF, IBAN, numar de telefon, parola, denumirea bancii, denumire completa, adresa sediu, api link si scurta descriere (https://github.com/celdotro/marketplace/wiki/Actualizare-informatii-cont)
     * [EN] Updates the following data of an affiliate: CIF, IBAN, phone number, password, bank's name, full name, headquarter's address, api link, and short description (https://github.com/celdotro/marketplace/wiki/Actualizare-informatii-cont)
     * @param null $cif
     * @param null $iban
     * @param null $telephone
     * @param null $password
     * @param null $bankName
     * @param null $fullName
     * @param null $hqAddress
     * @param null $description
     * @param null $apiLink
     * @param $contactPerson
     * @param $county
     * @param $city
     * @param $reg
     * @param int $timpProcesareImplicit
     * @return mixed
     * @throws \Exception
     */
    public function updateAccountInformation ($cif = NULL, $iban = NULL, $telephone = NULL, $password = NULL, $bankName = NULL, $fullName = NULL, $hqAddress = NULL, $description = NULL, $apiLink = NULL, $contactPerson, $county, $city, $reg, $timpProcesareImplicit = 0) {
        // Sanity check - skip it because it needs additional methods and packages which will just bloat this project
        // All proper checks for data integrity are done on our server

        // Set method and action
        $method = 'admininfo';
        $action = 'updateAccountInformation';

        // Set data
        $data = array();
        if(!is_null($cif)) $data['cif'] = $cif;
        if(!is_null($iban)) $data['iban'] = $iban;
        if(!is_null($telephone)) $data['telephone'] = $telephone;
        if(!is_null($password)) $data['password'] = $password;
        if(!is_null($bankName)) $data['bankName'] = $bankName;
        if(!is_null($fullName)) $data['fullName'] = $fullName;
        if(!is_null($hqAddress)) $data['hqAddress'] = $hqAddress;
        if(!is_null($description)) $data['description'] = $description;
        if(!is_null($apiLink)) $data['apiLink'] = $apiLink;
        $data['person'] = $contactPerson;
        $data['county'] = $county;
        $data['city'] = $city;
        $data['reg'] = $reg;
        $data['timpProcesareImplicit'] = $timpProcesareImplicit;

        if(empty($data)) throw new \Exception('Specificati cel putin 1 camp');

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, $data);

        return $result;
    }

    /**
     * [RO] Preia o lista cu informatii generale ale contului de afiliat (https://github.com/celdotro/marketplace/wiki/Listeaza-informatiile-contului)
     * [EN] Retrieves a list of general account information (https://github.com/celdotro/marketplace/wiki/List-account-information)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccountInformation(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getAccountInformation';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }

    /**
     * [RO] Preia notificarile aferente afiliatului (https://github.com/celdotro/marketplace/wiki/Preia-notificari)
     * [EN] Retrieves the notifications for the current affiliate (https://github.com/celdotro/marketplace/wiki/Get-notifications)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getNotifications(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getNotifications';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }

    /**
     * [RO] Marcheaza o notificare drept citita (https://github.com/celdotro/marketplace/wiki/Marcheaza-drept-citita)
     * [EN] Marks a notification as seen (https://github.com/celdotro/marketplace/wiki/Mark-as-seen)
     * @param $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function markAsSeen($id){
        // Set method and action
        $method = 'admininfo';
        $action = 'markAsSeen';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array('id' => $id));

        return $result;
    }

    /**
     * [RO] Preia diverse date despre afiliatul curent (https://github.com/celdotro/marketplace/wiki/Preia-date-despre-afiliat)
     * [EN] Retrieves miscellaneous data about an affiliate (https://github.com/celdotro/marketplace/wiki/Get-affiliate-data)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function markAllAsSeen(){
        // Set method and action
        $method = 'admininfo';
        $action = 'markAllAsSeen';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }

    /**
     * [RO] Marcheaza toate mesajele ca fiind citite (https://github.com/celdotro/marketplace/wiki/Marcheaza-toate-ca-fiind-citite)
     * [EN] Marks all notifications as read (https://github.com/celdotro/marketplace/wiki/Mark-all-as-read)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAffiliateData(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getAffiliateData';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }

    public function testLogin(){
        $data = array('username' => \celmarket\Auth::$username, 'password' => \celmarket\Auth::$password);
        $url = \celmarket\Config::$API_HTTP . 'login' . '/' . 'testLogin' . '/';


        try {
            $request = \celmarket\Dispatcher::getGuzzleClient()->request(
                'POST',
                $url,
                array(
                    'form_params' => $data,
                )
            );
        } catch (Exception $e) {
            echo '<pre>' . __FILE__ . ':' . __LINE__ . "\n";
            print_r($e->getResponse()->getStatusCode());
            echo '</pre>';
            die();
        }

        $jsonContents = $request->getBody()->getContents();
        $contents = json_decode($jsonContents);

        return $contents;
    }

    /**
     * [RO] Verifica paginile obligatorii (https://github.com/celdotro/marketplace/wiki/Verifica-pagini-obligatorii)
     * [EN] Checks the mandatory pages (https://github.com/celdotro/marketplace/wiki/Check-mandatory-pages)
     * @return mixed
     * @throws \Exception
     */
    public function checkMandatoryInfo(){
        // Set method and action
        $method = 'admininfo';
        $action = 'checkMandatoryInfo';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }

    /**
     * [RO] Preia adresele de contact (https://github.com/celdotro/marketplace/wiki/Preia-adrese-contact)
     * [EN] Get contact addresses (https://github.com/celdotro/marketplace/wiki/Get-contact)
     * @return mixed
     * @throws \Exception
     */
    public function getContact(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getContact';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }

    /**
     * [RO] Preia prefixul pentru adaugarea de produse cu acelasi model, dar producator sau categorie diferite (https://github.com/celdotro/marketplace/wiki/Preluare-prefix)
     * [EN] Get the product adding prefix for cases with the same model but different manufacturer or category (https://github.com/celdotro/marketplace/wiki/Get-prefix)
     * @return mixed
     * @throws \Exception
     */
    public function getPrefix(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getPrefix';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }

    /**
     * [RO] Listeaza paginile cu incalcari ale contractului (https://github.com/celdotro/marketplace/wiki/Listare-pagini-cu-incalcari-de-contract)
     * [EN] List pages that breach the contract (https://github.com/celdotro/marketplace/wiki/List-pages-that-breach-the-contract)
     * @return mixed
     * @throws \Exception
     */
    public function getPagesWithContractBreaches(){
        // Set method and action
        $method = 'admininfo';
        $action = 'getPagesWithContractBreaches';

        // Send request and retrieve response
        $result = Dispatcher::send($method, $action, array());

        return $result;
    }
}