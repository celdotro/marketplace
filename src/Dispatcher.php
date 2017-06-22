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

/**
 * Class Dispatcher
 * General capabilities:
 * - whitelist methods for unnecessary API calls
 * - build API's URL
 * - authenticate
 * - connect to API
 * - retrieve and do a basic processing of the response
 * @package celmarket
 */
class Dispatcher {

    /**
     * Send data to API and retrieve response
     * 1. Validate method and action, and builds URL based on these
     * 2. Authenticate user
     * 3. Instantiate a guzzleClient object and makes a POST request to the API server
     * 4. Process the response in order to throw relevant error messages or return the correctly formed response
     * @param $method
     * @param $action
     * @param $data
     * @throws \Exception
     */
    public static function send ($method, $action, $data) {
        ### 1. Validate method and action, and builds URL based on these ###
        // Sanity check
        if (is_null($method) || empty($method) || !self::whitelistMethod($method)) {
            throw new \Exception('Metoda invalida');
        }
        if (is_null($action) || empty($action)) {
            throw new \Exception('Actiune invalida');
        }
        if (is_null($data)) {
            throw new \Exception('Datele nu pot fi nule');
        }

        // Build URL
        $url = Config::API_HTTP . $method . '/' . $action . '/';

        ### 2. Authenticate user ##
        // Get Auth instance
        $auth = Auth::getInstance();
        try {
            // Retrieve token
            $token = $auth->getToken();
        } catch (Exception $e) {
            // If an Exception was caught, regenerate token
            $token = Auth::regenerateToken();
        }

        ### 3. Instantiate a guzzleClient object and makes a POST request to the API server ###
        // New GuzzleHttp client
        $guzzleClient = new Client(array('timeout' => Config::TIMEOUT));

        // Build POST request with token placed in bearer authorization header
        $request = $guzzleClient->request('POST', $url, array('form_params' => $data, 'headers' => array('Authorization' => 'Bearer ' . $token)));

        ### 4. Process the response in order to throw relevant error messages or return the correctly formed response ###
        // Retrieve and decode contents
        $jsonContents = $request->getBody()->getContents();
        $contents = json_decode($jsonContents);

        // Throw customised exception in case decoding fails
        if (json_last_error() !== 0) throw new \Exception('Eroare la parsarea raspunsului: ' . $jsonContents);

        // Return result
        if (is_object($contents)) { // Valid contents
            if (
                isset($contents->error) && $contents->error === 0
                && isset($contents->tokenStatus) && $contents->tokenStatus === 1
            ) { // No error and token ok
                if (isset($contents->message)) { // Has message
                    return $contents->message;
                } else { // Everything is fine, except the message
                    throw new \Exception('Eroare: continutul nu a fost primit');
                }
            } elseif (!isset($contents->tokenStatus) || $contents->tokenStatus === 0) { // Token problems
                throw new \Exception('Eroare: token invalid');
            } elseif (!isset($contents->error) || $contents->error !== 0) { // Error returned
                if (isset($contents->message) && $contents->message === 1) { // Standard error
                    throw new \Exception('Eroare: ' . $contents->message);
                } else { // Exotic error
                    throw new \Exception('Eroare: ' . $jsonContents);
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
        if (in_array($cName, array('home', 'products', 'orders', 'settings', 'import', 'example', 'campaign'))) {
            return true;
        }

        return false;
    }
}
