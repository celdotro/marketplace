<?php
use GuzzleHttp\Client;

class Dispatcher
{
    #TODO change url
//    const URL = 'http://192.168.0.85/market_api/Orders/getOrders'; // API
    const URL = 'http://192.168.0.85/an_v2/marketplaceapi';
    const TIMEOUT = 5; // 5s timeout

    /**
     * Send data to API and retrieve response
     * @param $method
     * @param $action
     * @param $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public static function send($method, $action, $data)
    {
        // Sanity check
        if (is_null($method) || empty($method) || !self::whitelistMethod($method)) {
            throw new Exception('Metoda invalida');
        }
        if (is_null($action) || empty($action)) {
            throw new Exception('Actiune invalida');
        }
        if (is_null($data) || empty($data)) {
            throw new Exception('Parametri invalizi');
        }

        // Set send data
        $sData  =   array('controller' => $method, 'action' => $action, 'params' => $data);

        #TODO add login
        // Check login
//        if($method != 'login' && 1==2) {
//            if (empty($_SERVER['token'])) return array('status' => __LINE__, 'message' => 'Token invalid');
//            $datadec = UserController::decodeToken($_SERVER['token']);
//            if (empty($datadec['token'])) return array('status' => __LINE__, 'message' => 'Token invalid');
//            $sdata['token']   =   $datadec['token'];
//            if (empty($_SERVER['fid'])) return array('status' => __LINE__, 'message' => 'Token invalid');
//            $sdata['fid']       =   (int)$_SERVER['fid'];
//            if ($sdata['fid'] != (int)UserController::underute($datadec['fid'])) return array('status' => __LINE__, 'message' => 'Token invalid');
//        }

        #TODO add fid
        // Set fid
        $sData['fid']    =    22;

        #TODO add token
        // Set token
        $sData['token'] = 'abc';

        // New GuzzleHttp client
        $guzzleClient = new Client(array('timeout'  => self::TIMEOUT));

        // Get POST request response
        $response = $guzzleClient->request('POST', self::URL, array('form_params' => $sData));

        // Parse contents
        $contents = $response->getBody()->getContents();
        die($contents);

        $contents = json_decode($contents);
        if ($contents->status == 500) { // 500 = error
            throw new \Exception('Eroare: ' . $contents->data);
        } elseif ($contents->status != 200) { // != 200 = unkown error
            throw new \Exception('Eroare cu status necunoscut ' . $contents->status . ' : ' . $contents->data);
        }

        // If status == 200, return data
        return $contents->data;
    }

    /**
     * Check method name against a whitelist
     * @param $cName
     * @return bool
     */
    public static function whitelistMethod($cName)
    {
        if (in_array($cName, array('home', 'products', 'orders'))) {
            return true;
        }
        return false;
    }
}
