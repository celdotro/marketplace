<?php
namespace celmarket;

/**
 * For custom authentication methods user need to extend this class
 */
abstract class AuthProvider
{
    abstract public function __construct($userName = '', $password = '');

    public static function checkToken()
    {
    }
    
    public static function getToken()
    {
    }
    
    public static function regenerateToken()
    {
    }
    
    public static function setProviderID($providerID = '')
    {
    }
}
