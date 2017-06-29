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
//    const API_HTTP = 'http://192.168.0.85/market_api/';
    const API_HTTP = 'http://marketplace.cel.ro/market_api/';

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