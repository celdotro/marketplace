<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'vendor/autoload.php';

use celmarket\Auth;
Auth::setUserDetails('mbd', 'acadele');
$auth = Auth::getInstance();
$token = $auth->getToken();
var_dump($token);
