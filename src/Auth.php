<?php
namespace celmarket;

use celmarket\AuthProviderFile;
use celmarket\Dispatcher;
include_once __DIR__ . '/Sentry.php';

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
    public static $username = null;
    public static $password = null;

    /**
     * Set username and password
     * @param $username
     * @param $password
     * @throws \Exception
     */
    public static function setUserDetails($username, $password, $class = null)
    {
        // Sanity check
        if (!isset($username) || is_null($username) || empty($username)) {
            throw new \Exception('Specificati un nume de utilizator valid');
        }
        if (!isset($password) || is_null($password) || empty($password)) {
            throw new \Exception('Specificati o parola valida');
        }

        // Set attributes
        self::$username = $username;
        self::$password = $password;
        
        $_SERVER['username'] = $username;

        if (is_null($class)) {
            $authProvider = new AuthProviderFile($username, $password);
        } else {
            $authProvider = new $class($username, $password);
            if (!($authProvider instanceof AuthProvider)) {
                throw new \Exception('Clasa specificata trebuie sa extinda celmarket\AuthProvider.');
            }
        }

        $_SERVER['authprovider'] = get_class($authProvider);

        Dispatcher::setProvider($authProvider);
        $authProvider::checkToken();
    }

    /**
     * Singleton -> prevent unserializing
     */
    private function __wakeup()
    {
        return;
    }

    /**
     * Singleton -> prevent instance cloning
     */
    private function __clone()
    {
        return;
    }
}
