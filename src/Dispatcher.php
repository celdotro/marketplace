<?php

namespace celmarket;

ini_set('xdebug.var_display_max_depth', '10');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');

include_once __DIR__ . '/Sentry.php';

/**
 * Error reporting for testing purposes - commented out because it contains rarely used code that only adds unnecessary steps.
 * In order to use this, simply uncomment it and change the TEST constant initialization to true
 */
//define('TEST', false);
//if (defined('TEST') && TEST) {
//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
//}

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use celmarket\ResponseException;

/**
 * Class Dispatcher
 *  WIKI
 *      [RO]: https://github.com/celdotro/marketplace/wiki/Informatii-generale#dispatcher
 *      [EN]: https://github.com/celdotro/marketplace/wiki/General-Information#dispatcher
 * General capabilities:
 * - instantiates a connection that can be retrieved for further use
 * - whitelist methods for unnecessary API calls
 * - build API's URL
 * - authenticate
 * - connect to API
 * - retrieve and do a basic processing of the response
 * @package celmarket
 */
class Dispatcher
{
	private static $guzzleClient = null;
	private static $failCount;
	private static $provider;

	/**
	 * Dispatcher constructor.
	 */
	private function __construct()
	{
		throw new ResponseException('Nu puteti instantia un obiect cu clasa Dispatcher');
	}

	/**
	 * Send data to API and retrieve response
	 * 0. Check fail count
	 * 1. Validate method and action, and build URL based on these
	 * 2. Authenticate user
	 * 3. Uses dispatcher's guzzleClient object and makes a POST request to the API server
	 * 4. Process the response in order to throw relevant error messages or return the correctly formed response
	 * @param $method
	 * @param $action
	 * @param $data
	 * @param null $files
	 * @return mixed
	 * @throws \Exception
	 */
	public static function send($method, $action, $data, $files = null, $retryResponse = null)
	{
		### 0. Check fail count ###
		if (!isset(self::$failCount) || is_null(self::$failCount)) {
			self::$failCount = 0;
		}

		if (is_null(self::$provider) || empty(self::$provider)) {
			throw new ResponseException('Eroare la accesarea clasei derivate AuthProvider');
		}

		self::$failCount++;
		$isLogin = false;

		if (self::$failCount > Config::MAX_FAILCOUNT) {
			if (!empty($retryResponse)) {
				throw new ResponseException($retryResponse, ['method' => $method, 'data' => $data, 'action' => $action]);
			} else {
				throw new ResponseException('Autentificarea a esuat', ['method' => $method, 'data' => $data, 'action' => $action]);
			}
		}

		### 1. Validate method and action, and build URL based on these ###
		// Sanity check
		if (!isset($method) || is_null($method) || empty($method) || !self::whitelistMethod($method)) {
			throw new ResponseException('Metoda invalida', ['method' => $method, 'data' => $data, 'action' => $action]);
		}
		if (!isset($action) || is_null($action) || empty($action)) {
			throw new ResponseException('Actiune invalida', ['method' => $method, 'data' => $data, 'action' => $action]);
		}
		if (!isset($data) || is_null($data)) {
			throw new ResponseException('Datele nu pot fi nule', ['method' => $method, 'data' => $data, 'action' => $action]);
		}

		// Build URL
		$url = Config::$API_HTTP . $method . '/' . $action . '/';
		$provider = self::$provider;

		### 2. Authenticate user ##
		$token = '';
		// Only get another instance if the method is not login
		if ($method != 'login' && $action != 'actionLogin') {
			// Get Auth instance
			$token = $provider::getToken();
		} else {
			$isLogin = true;
		}

		### 3. Uses dispatcher's guzzleClient object and makes a POST request to the API server ###
		// Check if test server has to be used
		if (Config::TEST) {
			$data['test'] = 1;
		}
		$data['api_version'] = Config::CURRENT_VERSION;

		$_SERVER['reqData'] = $data;
		$_SERVER['reqAction'] = $action;
		$_SERVER['reqMethod'] = $method;

		// Build POST request with token placed in bearer authorization header
		$request = null;
		$headers = [];
		try {
			if (is_null($files)) { // No files to upload
				if (!Config::$IS_LIVE) {
					$headers['DEMO'] = 1;
				}

				$headers['AUTH'] = 'Bearer ' . $token;

				$request = self::getGuzzleClient()->request(
					'POST',
					$url,
					array(
						'form_params' => $data,
						'headers' => $headers,
					)
				);
			} else { // Has files to upload
				/// Headers
				$options = array(
					'headers' => array('AUTH' => 'Bearer ' . $token),
				);

				/// Regular fields
				foreach ($data as $name => $value) {
					$options['multipart'][] = array(
						'name' => $name,
						'contents' => $value
					);
				}

				/// Files
				foreach ($files as $fileName => $fileContents) {
					$options['multipart'][] = array(
						'name' => $fileName,
						'contents' => $fileContents,
						'filename' => $fileName
					);
				}

				$request = self::getGuzzleClient()->request(
					'POST',
					$url,
					$options
				);
			}
		} catch (RequestException $e) { // If a request exception is encountered
			if ($e->hasResponse()) {
				if ($e->getResponse()->getStatusCode() == 400) { // If the exception has code 400, regenerate token
					if (!$isLogin) {
						$token = $provider::regenerateToken();
					}
					return self::send($method, $action, $data, $files);
				}
			}
			throw new ResponseException('Eroare la apelarea API-ului. Trimite-ti pe dp@cel.ro stack trace-ul acestei exceptii.', ['method' => $method, 'data' => $data, 'action' => $action, 'e' => $e]);
		}

		### 4. Process the response in order to throw relevant error messages or return the correctly formed response ###
		// Retrieve and decode contents
		$jsonContents = $request->getBody()->getContents();
		$contents = json_decode($jsonContents);

		// Throw customised exception in case decoding fails
		if (json_last_error() !== JSON_ERROR_NONE) {
			throw new ResponseException('Eroare la parsarea raspunsului: ' . $jsonContents, ['method' => $method, 'data' => $data, 'action' => $action]);
		}

		// Check if the response returned a 302 error, in which case rerun this method
		if ($contents->error == 302 || $contents->error == 403 || $contents->error == 405) {
			$message = !empty($contents->message) && is_string($contents->message) ? $contents->message : null;
			if (!$isLogin) {
				$token = $provider::regenerateToken();
			}
			return self::send($method, $action, $data, null, $message);
		} else {
			self::$failCount = 0;
		}

		// Return result
		if (is_object($contents)) { // Valid contents
			if (
				isset($contents->error) && $contents->error === 0
				&& isset($contents->tokenStatus) && $contents->tokenStatus === 1
			) { // No error and token ok
				if (isset($contents->message)) { // Has message
					return $contents->message;
				} else { // Everything is fine, except the message
					throw new ResponseException('Eroare: continutul nu are o forma adecvata : ' . $jsonContents, ['method' => $method, 'data' => $data, 'action' => $action]);
				}
			} elseif (!isset($contents->tokenStatus) || $contents->tokenStatus === 0) { // Token problems
				if (isset($contents->error) && ($contents->error == 405 || $contents->error == 403)) {
					if (!empty($contents->message) && is_string($contents->message)) {
						throw new ResponseException($contents->message, ['method' => $method, 'data' => $data, 'action' => $action]);
					} else {
						throw new ResponseException('Date de autentificare incorecte', ['method' => $method, 'data' => $data, 'action' => $action]);
					}
				}
				if (!$isLogin) {
					$token = $provider::regenerateToken();
				}
				return self::send($method, $action, $data, null, $message);
				throw new ResponseException('Eroare: token invalid', ['method' => $method, 'data' => $data, 'action' => $action]);
			} elseif (!isset($contents->error) || $contents->error !== 0) { // Error returned
				if (isset($contents->message)) { // Standard error
					return $contents;
				} else { // Exotic error
					throw new ResponseException('Eroare neasteptata: ' . $jsonContents, ['method' => $method, 'data' => $data, 'action' => $action]);
				}
			}
		} else { // Invalid contents
			throw new ResponseException('Eroare: continutul are un format invalid: ' . $jsonContents, ['method' => $method, 'data' => $data, 'action' => $action]);
		}
	}

	/**
	 * Check method name against a whitelist
	 * @param $cName
	 * @return bool
	 */
	public static function whitelistMethod($cName)
	{
		if (in_array($cName, array('home', 'products', 'orders', 'settings', 'import', 'login', 'campaign', 'admininfo', 'email', 'reports', 'commissions', 'coupons'))) {
			return true;
		}

		return false;
	}

	/**
	 * Enforces the use of a single connection
	 * @return Client|null
	 */
	public static function getGuzzleClient()
	{
		if (!isset(self::$guzzleClient) || is_null(self::$guzzleClient)) {
			self::$guzzleClient = new Client(array('timeout' => Config::TIMEOUT, 'connection_timeout' => Config::CONN_TIMEOUT, 'verify' => Config::$IS_LIVE));
		}

		return self::$guzzleClient;
	}

	public static function setProvider($class)
	{
		self::$provider = $class;
	}

	/**
	 * Singleton -> prevent unserializing
	 */
	private function __wakeup()
	{
		return;
	}

	/**
	 * Singleton -> prevent instance cloning
	 */
	private function __clone()
	{
		return;
	}
}
