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

    private function __construct($regenerate = false)
    {
        if (empty(static::$username) || empty(static::$password)) {
            throw new \Exception('Username or password is missing');
        }
        if (file_exists(Config::TOKEN_PATH) && !$regenerate) {
            static::$token = file_get_contents(Config::TOKEN_PATH);
            return true;
        }
        $guzzleClient = new Client(array('timeout'  => 5));
        $response = $guzzleClient->request('POST', Config::MIDDLE_HTTP . 'login/actionLogin', array('form_params' => array('username' => static::$username, 'password' => static::$password)));
        $body = $response->getBody()->getContents();
        try {
            $res = json_decode($body, true);
            if ($res['tokenStatus']) {
                static::$token = $res['message'];
                file_put_contents(Config::TOKEN_PATH, $res['message']);
            }
        } catch (\Exception $e) {
            echo 'Caught exception: Error in contacting server for authentification', "\n";
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

    public static function setUserDetails($username = null, $password = null)
    {
        if (empty($username) || empty($password)) {
            throw new \Exception('Username or password is missing');
        }
        self::$username = $username;
        self::$password = $password;
    }

    public function getToken()
    {
        return file_exists(Config::TOKEN_PATH) ? file_get_contents(Config::TOKEN_PATH) : static::regenerateToken();
    }
}
