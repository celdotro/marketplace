<?php

namespace celmarket;

/**
 * Error reporting for testing purposes - commented out because it contains rarely used code that only adds unnecessary steps.
 * In order to use this, simply uncomment it and change the TEST constant initialization to true
 */
//define('TEST', false);
//if (defined('TEST') && TEST) {
//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
//}

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Dispatcher
 *  WIKI
 *      [RO]: https://github.com/celdotro/marketplace/wiki/Informatii-generale#dispatcher
 *      [EN]: https://github.com/celdotro/marketplace/wiki/General-Information#dispatcher
 * General capabilities:
 * - instantiates a connection that can be retrieved for further use
 * - whitelist methods for unnecessary API calls
 * - build API's URL
 * - authenticate
 * - connect to API
 * - retrieve and do a basic processing of the response
 * @package celmarket
 */
class Dispatcher {

    private static $guzzleClient = NULL;
    private static $failCount;

    /**
     * Dispatcher constructor.
     */
    private function __construct () {
        throw new \Exception('Nu puteti instantia un obiect cu clasa Dispatcher');
    }

    /**
     * Send data to API and retrieve response
     * 0. Check fail count
     * 1. Validate method and action, and build URL based on these
     * 2. Authenticate user
     * 3. Uses dispatcher's guzzleClient object and makes a POST request to the API server
     * 4. Process the response in order to throw relevant error messages or return the correctly formed response
     * @param $method
     * @param $action
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public static function send ($method, $action, $data) {
        ### 0. Check fail count ###
        if (!isset(self::$failCount) || is_null(self::$failCount)) self::$failCount = 0;
        self::$failCount++;

        if (self::$failCount > Config::MAX_FAILCOUNT) throw new \Exception('Autentificarea a esuat');

        ### 1. Validate method and action, and build URL based on these ###
        // Sanity check
        if (!isset($method) || is_null($method) || empty($method) || !self::whitelistMethod($method)) {
            throw new \Exception('Metoda invalida');
        }
        if (!isset($action) || is_null($action) || empty($action)) {
            throw new \Exception('Actiune invalida');
        }
        if (!isset($data) || is_null($data)) {
            throw new \Exception('Datele nu pot fi nule');
        }

        // Build URL
        $url = Config::API_HTTP . $method . '/' . $action . '/';

        ### 2. Authenticate user ##
        $token = '';
        // Only get another instance if the method is not login
        if ($method != 'login' && $action != 'actionLogin') {
            // Get Auth instance
            $auth = Auth::getInstance();
            try {
                // Retrieve token
                $token = $auth->getToken();
            } catch (\Exception $e) {
                // If an Exception was caught, regenerate token
                $token = Auth::regenerateToken();
            }
        }

        ### 3. Uses dispatcher's guzzleClient object and makes a POST request to the API server ###
        // Check if test server has to be used
        if (Config::TEST) $data['test'] = 1;

        // Build POST request with token placed in bearer authorization header
        try {
            $request = self::getGuzzleClient()->request('POST', $url, array('form_params' => $data, 'headers' => array('AUTH' => 'Bearer ' . $token)));
        } catch (RequestException $e) { // If a request exception is encountered
           if ($e->getResponse()->getStatusCode() == 400){ // If the exception has code 400, regenerate token
               $token = Auth::regenerateToken();
               return self::send($method, $action, $data);
           }
        }
        ### 4. Process the response in order to throw relevant error messages or return the correctly formed response ###
        // Retrieve and decode contents
        $jsonContents = $request->getBody()->getContents();
        $contents = json_decode($jsonContents);

        // Throw customised exception in case decoding fails
        if (json_last_error() !== 0) throw new \Exception('Eroare la parsarea raspunsului: ' . $jsonContents);

        // Check if the response returned a 302 error, in which case rerun this method
        if ($contents->error == 302) {
            $token = Auth::regenerateToken();
            return self::send($method, $action, $data);
        } else {
            self::$failCount = 0;
        }

        // Return result
        if (is_object($contents)) { // Valid contents
            if (
                isset($contents->error) && $contents->error === 0
                && isset($contents->tokenStatus) && $contents->tokenStatus === 1
            ) { // No error and token ok
                if (isset($contents->message)) { // Has message
                    return $contents->message;
                } else { // Everything is fine, except the message
                    throw new \Exception('Eroare: continutul nu are o forma adecvata : ' . $jsonContents);
                }
            } elseif (!isset($contents->tokenStatus) || $contents->tokenStatus === 0) { // Token problems
                throw new \Exception('Eroare: token invalid');
            } elseif (!isset($contents->error) || $contents->error !== 0) { // Error returned
                if (isset($contents->message)) { // Standard error
                    return $contents;
                } else { // Exotic error
                    throw new \Exception('Eroare neasteptata: ' . $jsonContents);
                }
            }
        } else { // Invalid contents
            throw new \Exception('Eroare: continutul are un format invalid: ' . $jsonContents);
        }
    }

    /**
     * Check method name against a whitelist
     * @param $cName
     * @return bool
     */
    public static function whitelistMethod ($cName) {
        if (in_array($cName, array('home', 'products', 'orders', 'settings', 'import', 'login', 'campaign', 'admininfo', 'email'))) {
            return true;
        }

        return false;
    }

    /**
     * Enforces the use of a single connection
     * @return Client|null
     */
    public static function getGuzzleClient () {
        if (!isset(self::$guzzleClient) || is_null(self::$guzzleClient))
            self::$guzzleClient = new Client(array('timeout' => Config::TIMEOUT, 'connection_timeout' => Config::CONN_TIMEOUT));

        return self::$guzzleClient;
    }

    /**
     * Singleton -> prevent unserializing
     */
    private function __wakeup () {
        return;
    }

    /**
     * Singleton -> prevent instance cloning
     */
    private function __clone () {
        return;
    }
}
