<?php
namespace celmarket;

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
        try {
            if (file_exists(Config::TOKEN_PATH) && !$regenerate) {
                // Read the token file and set the static attribute $token with the file content
                static::$token = file_get_contents(Config::TOKEN_PATH);
                // If token is not empty, then return true, otherwise delete the token's file and continue
                if (static::$token !== '') return true;
                else unlink(Config::TOKEN_PATH);
            }
        } catch (\Exception $e) {
            throw new \Exception('Eroare la procesarea fisierului: ' . Config::TOKEN_PATH);
        }

        ### 3. Process response ###
        $res = Dispatcher::send('login', 'actionLogin', array('username' => static::$username, 'password' => static::$password));
        try{
            if($res === ''){ // Token is null
                throw new \Exception('Token-ul primit este null');
            } elseif(is_string($res) && strstr($res, 'Raspuns invalid:') !== false){ // Invalid answer
                throw new \Exception($res);
            }elseif(file_put_contents(Config::TOKEN_PATH, $res) === false){ // File can't be written
                throw new \Exception('Fisierul nu poate fi scris: ' . Config::TOKEN_PATH);
            }

            // Token static attribute gets the value of the response
            static::$token = $res;
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
     * @return null
     */
    public static function getUsername () {
        return self::$username;
    }

    /**
     * @return null
     */
    public static function getPassword () {
        return self::$password;
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
        if(!isset($username) || is_null($username) || empty($username)) throw new \Exception('Specificati un nume de utilizator valid');
        if(!isset($password) || is_null($password) || empty($password)) throw new \Exception('Specificati o parola valida');

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
