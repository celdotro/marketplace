<?php
namespace celmarket;

class AuthProvider
{
    private static $token;
    private static $_TOKEN_PATH;
    private static $user;
    private static $password;

    public function __construct($userName = '', $password = '')
    {
        if (empty($userName) || empty($password)) {
            throw new \Exception('Username or password is missing');
        }
        self::$user = trim($userName);
        self::$password = trim($password);
    }

    public static function checkToken()
    {
        self::$_TOKEN_PATH = __DIR__ . '/' . md5(self::$user . self::$password);
        return file_exists(self::$_TOKEN_PATH) ? static::$token : self::regenerateToken();
    }
    
    public static function getToken()
    {
        if (!empty(static::$token)) {
            return static::$token;
        }
        if (empty(self::$_TOKEN_PATH)) {
            self::$_TOKEN_PATH = __DIR__ . '/' . md5(self::$user . self::$password);
        }
        if (file_exists(self::$_TOKEN_PATH)) {
            return file_get_contents(self::$_TOKEN_PATH);
        }
        return self::regenerateToken();
    }
    
    public static function regenerateToken()
    {
        ### 1. Sanity check ###
        if (empty(self::$user) || empty(self::$password)) {
            throw new \Exception('Username or password is missing');
        }
        $res = Dispatcher::send('login', 'actionLogin', array('username' => self::$user, 'password' => self::$password));

        try {
            if ($res === '') { // Token is null
                throw new \Exception('Token-ul primit este null');
            } elseif (is_string($res) && strstr($res, 'Raspuns invalid:') !== false) { // Invalid answer
                throw new \Exception($res);
            } elseif (file_put_contents(self::$_TOKEN_PATH, $res) === false) { // File can't be written
                throw new \Exception('Fisierul nu poate fi scris: ' . self::$_TOKEN_PATH);
            }

            // Token static attribute gets the value of the response
            self::$token = $res;
            return self::$token;
        } catch (\Exception $e) {
            // Catch all exceptions, add a message for clarification and re-throw them up the stack
            throw new \Exception('Eroare in procesul de autentificare: ' . $e->getMessage());
        }
    }
}
