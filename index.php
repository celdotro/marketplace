<?php
/**
 * Dependencies autoloader
 */
include __DIR__ . '/vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use celmarket\Auth;
Auth::setUserDetails('test', 'CorsarOnline8080$');
