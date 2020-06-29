<?php
/**
 * Dependencies autoloader
 */
include __DIR__ . '/vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$composer = file_get_contents(__DIR__ . '/composer.json');
if(!empty($composer)) {
	$decoded = @json_decode($composer, true);
} else {
	$decoded = false;
}

$version = !empty($decoded['version']) ? $decoded['version'] : 'UNKWN';

Sentry\init(['dsn' => 'https://e25a0133dc72473b96b7aa7b04fdf067@sentry.cel.ro/5' , 'release' => $version]);


Sentry\configureScope(function (Sentry\State\Scope $scope): void {
	$scope->setExtra('argv', $_SERVER['argv']);
	$scope->setExtra('scriptName', $_SERVER['SCRIPT_NAME']);

	if(!empty($_SERVER['ap'])) $scope->setExtra('authProvider', $_SERVER['ap']);
	if(!empty($_SERVER['PWD'])) $scope->setExtra('pwd', $_SERVER['PWD']);
});
