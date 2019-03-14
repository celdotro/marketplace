<?php
namespace celmarket;

/**
 * For custom authentication methods user need to extend this class
 */
abstract class AuthProvider
{
    abstract public function __construct($userName = '', $password = '');

    abstract public static function checkToken();
    
    abstract public static function getToken();
    
    abstract public static function regenerateToken();
    
    abstract public static function setProviderID($providerID = '');
}
