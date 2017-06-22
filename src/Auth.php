<?php
namespace celmarket;

use GuzzleHttp\Client;

/**
 * Class Auth - implements singleton pattern
 *  WIKI
 *      [RO]: https://github.com/celdotro/marketplace/wiki/Informatii-generale#auth
 *      [EN]: https://github.com/celdotro/marketplace/wiki/General-Information#auth
 * @package celmarket
 */
class Auth
{
    // Singleton instance
    private static $_instance = null;

    // Data necesary for authentication
    private static $username = null;
    private static $password = null;
    private static $token = null;

    /**
     * Auth constructor.
     * 1. Sanity check
     * 2. Get authentication token
     * 3. Process response
     * @param bool $regenerate
     * @throws \Exception
     */
    private function __construct($regenerate = false)
    {
        ### 1. Sanity check ###
        if (empty(static::$username) || empty(static::$password)) {
            throw new \Exception('Username or password is missing');
        }

        ### 2. Get authentication token ###
        // Check if token exists and there is no need to regenerate
        if (file_exists(Config::TOKEN_PATH) && !$regenerate) {
            // Read the token file and set the static attribute $token with the file content
            static::$token = file_get_contents(Config::TOKEN_PATH);
            return true;
        }

        // If token doesn't exist or if regeneration is imposed, then retrieve a new token from the server using Guzzle
        //// New Guzzle client
        $guzzleClient = new Client(array('timeout'  => Config::TIMEOUT));
        //// Send POST request to the login page
        $response = $guzzleClient->request('POST', Config::API_HTTP . 'login/actionLogin', array('form_params' => array('username' => static::$username, 'password' => static::$password)));
        //// Retrieve response
        $body = $response->getBody()->getContents();

        ### 3. Process response ###
        // Decode the response
        $res = json_decode($body, true);
        // Throw error if the response is not a JSON object
        if (json_last_error() !== 0) throw new \Exception('Eroare la parsarea raspunsului trimis de serverul de autentificare: ' . $body);

        // Further process decoded response
        try{
            if (!is_null($res['tokenStatus']) && !is_null($res['message']) && $res['tokenStatus']) { // Check if the response has a valid form and the token status is true
                // Write the message content in the token file ($res['message'] is the token)
                file_put_contents(Config::TOKEN_PATH, $res['message']);
                // Set the static attribute $token with the message content
                static::$token = $res['message'];
            } else {
                // Throw invalid response exception and add the received response in it's undecoded form
                throw new \Exception('Raspuns invalid: ' . $body);
            }
        } catch (\Exception $e) {
            // Catch all exceptions, add a message for clarification and re-throw them up the stack
            throw new \Exception('Eroare in procesul de autentificare: ' . $e->getMessage());
        }
    }

    /**
     * Retrieve singleton's instance
     * @return Auth|null
     */
    public static function getInstance()
    {
        // Check if instance exists and if it doesn't exist (singleton's first use), then generate one
        if (empty(self::$_instance)) {
            self::$_instance = new Auth();
        }
        return self::$_instance;
    }

    /**
     * Regenerate authentication token
     * @return null
     */
    public static function regenerateToken()
    {
        // Call constructor with forced regeneration
        self::$_instance = new Auth(true);
        return self::$token;
    }

    /**
     * Set username and password
     * @param $username
     * @param $password
     * @throws \Exception
     */
    public static function setUserDetails($username, $password)
    {
        // Sanity check
        if(is_null($username) || empty($username)) throw new \Exception('Specificati un nume de utilizator valid');
        if(is_null($password) || empty($password)) throw new \Exception('Specificati o parola valida');

        // Set attributes
        self::$username = $username;
        self::$password = $password;
    }

    /**
     * Token retrieval logic
     * @return bool|null|string
     */
    public function getToken()
    {
        return file_exists(Config::TOKEN_PATH) ? file_get_contents(Config::TOKEN_PATH) : static::regenerateToken();
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
