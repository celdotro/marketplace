<?php
/**
 * Error reporting for testing purposes
 */
define('TEST', true);
if(defined('TEST') && TEST) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

/**
 * Dependencies autoloader
 */
include 'vendor/autoload.php';

/**
 * User authentication data
 *
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * !!!!!!!! CHANGE THIS !!!!!!!!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
define('USER', 'mbd');
define('PASS', 'acadele');