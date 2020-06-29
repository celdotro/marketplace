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
    const CURRENT_VERSION = '1.21';
}

$version = !empty(Config::CURRENT_VERSION) ? Config::CURRENT_VERSION : 'UNKWN';

\Sentry\init(['dsn' => 'https://e25a0133dc72473b96b7aa7b04fdf067@sentry.cel.ro/5' , 'release' => $version]);


\Sentry\configureScope(function (\Sentry\State\Scope $scope): void {
    $scope->setExtra('argv', $_SERVER['argv']);
    $scope->setExtra('scriptName', $_SERVER['SCRIPT_NAME']);

    if(!empty($_SERVER['ap'])) $scope->setExtra('authProvider', $_SERVER['ap']);
    if(!empty($_SERVER['PWD'])) $scope->setExtra('pwd', $_SERVER['PWD']);
    if(!empty($_SERVER['username'])) $scope->setExtra('username', $_SERVER['username']);
    if(!empty($_SERVER['authprovider'])) $scope->setExtra('authProvider', $_SERVER['authprovider']);
});
