<?php

namespace celmarket;

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
    public static $API_HTTP = 'https://api-mp.cel.ro/market_api/';

    // Is live
    public static $IS_LIVE = true;

    // Set link to demo server
    public static function setDemo()
    {
        self::$API_HTTP = 'https://api-mp.cel.ro/market_api/';
        self::$IS_LIVE = false;
    }

    // Response timeout
    const TIMEOUT = 30; // 30 seconds

    // Connection timeout
    const CONN_TIMEOUT = 5; // 5 seconds

    // Use test server
    const TEST = true;

    // Maximum number of times Dispatcher is allowed to fail
    const MAX_FAILCOUNT = 10;

    // Current version
    const CURRENT_VERSION = '1.18.2';
}
