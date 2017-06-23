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
    const API_HTTP = 'http://192.168.0.85/market_api/';

    // Path to token file
    const TOKEN_PATH = './token';

    // Connection timeout
    const TIMEOUT = 30; // 30 seconds
}