<?php
namespace celmarket;

/**
 * 02.07.2020 / v2.0.1 Alin Tanase
 * Added Sentry reporting for easier debug
 * Initial file version
 */
$version = !empty(Config::CURRENT_VERSION) ? Config::CURRENT_VERSION : 'UNKWN';

\Sentry\init(['dsn' => Config::SENTRY_DNS , 'release' => $version]);


\Sentry\configureScope(function (\Sentry\State\Scope $scope): void {
    if(isset($_SERVER['argv'])) {
        $scope->setExtra('argv', $_SERVER['argv']);
    }
    if(isset($_SERVER['scriptName'])) {
        $scope->setExtra('scriptName', $_SERVER['SCRIPT_NAME']);
    }

    if(!empty($_SERVER['ap'])) $scope->setExtra('authProvider', $_SERVER['ap']);
    if(!empty($_SERVER['PWD'])) $scope->setExtra('pwd', $_SERVER['PWD']);
    if(!empty($_SERVER['username'])) $scope->setExtra('username', $_SERVER['username']);
    if(!empty($_SERVER['authprovider'])) $scope->setExtra('authProvider', $_SERVER['authprovider']);
});