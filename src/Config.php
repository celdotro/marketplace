<?php

namespace celmarket;

define('TOKEN',  '.' . DIRECTORY_SEPARATOR . 'token');

/**
 * Class Config - contains constants with general purpose data
 *  WIKI
 *      [RO]: https://github.com/celdotro/marketplace/wiki/Informatii-generale#config
 *      [EN]: https://github.com/celdotro/marketplace/wiki/General-Information#config
 * @package celmarket
 */
class Config
{
    // API's address
    static $API_HTTP = 'https://marketplace.cel.ro/market_api/';

    // Is live
    static $IS_LIVE = true;

    // Set link to demo server
    public static function setDemo(){
        self::$API_HTTP = 'https://demo.cel.ro/market_api/';
        self::$IS_LIVE = false;
    }

    // Path to token file
    const TOKEN_PATH = TOKEN;

    // Response timeout
    const TIMEOUT = 30; // 30 seconds

    // Connection timeout
    const CONN_TIMEOUT = 5; // 5 seconds

    // Use test server
    const TEST = true;

    // Maximum number of times Dispatcher is allowed to fail
    const MAX_FAILCOUNT = 10;
}