<?php
namespace celmarket;

use GuzzleHttp\Client;
use celmarket\Config;

class Auth
{
    private static $_instance = null;

    private static $username = null;
    private static $password = null;
    private static $token = null;

    const TIMEOUT = 30; // 30s timeout

    private function __construct($regenerate = false)
    {
        if (empty(static::$username) || empty(static::$password)) {
            throw new \Exception('Username or password is missing');
        }
        if (file_exists(Config::TOKEN_PATH) && !$regenerate) {
            static::$token = file_get_contents(Config::TOKEN_PATH);
            return true;
        }
        $guzzleClient = new Client(array('timeout'  => self::TIMEOUT));
        $response = $guzzleClient->request('POST', Config::API_HTTP . 'login/actionLogin', array('form_params' => array('username' => static::$username, 'password' => static::$password)));
        $body = $response->getBody()->getContents();
        $res = json_decode($body, true);
        if (json_last_error() !== 0) throw new \Exception('Eroare la parsarea raspunsului trimis de serverul de autentificare: ' . $body);
        try{
            if ($res['tokenStatus']) {
                static::$token = $res['message'];
                file_put_contents(Config::TOKEN_PATH, $res['message']);
            }
        } catch (\Exception $e) {
            throw new \Exception('Eroare in procesul de autentificare: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new Auth();
        }
        return self::$_instance;
    }

    public static function regenerateToken()
    {
        self::$_instance = new Auth(true);
        return self::$token;
    }

    public static function setUserDetails($username, $password)
    {
        if(is_null($username) || empty($username)) throw new \Exception('Specificati un nume de utilizator valid');
        if(is_null($password) || empty($password)) throw new \Exception('Specificati o parola valida');

        self::$username = $username;
        self::$password = $password;
    }

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
