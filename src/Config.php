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

    // API's address when client certificate (mTLS) authentication is used
    const API_HTTP_MTLS = 'https://apimtls-mp.cel.ro/market_api/';

    // Is live
    public static $IS_LIVE = true;

    // Absolute path to the client certificate (.pem) on disk, null when unused
    public static $CERTIFICATE = null;

    // Passphrase of the private key inside the certificate, null when it has none
    public static $CERTIFICATE_PASSPHRASE = null;

    // Set link to demo server
    public static function setDemo()
    {
        // A certificate already switched the address to the mTLS host, and that is
        // the only address which accepts it - do not switch it back
        if (empty(self::$CERTIFICATE)) {
            self::$API_HTTP = 'https://api-mp.cel.ro/market_api/';
        }

        self::$IS_LIVE = false;

        // 'verify' changed, and the connection is built once with the options
        // available at that moment
        Dispatcher::resetGuzzleClient();
    }

    /**
     * Set the client certificate (mTLS) used for every API call
     *
     * [RO] Certificatul se genereaza din panoul de vanzator (Cont > Informatii >
     * Securitate) si se descarca O SINGURA DATA, ca un singur fisier .pem care
     * contine si certificatul si cheia privata. Setarea lui comuta automat
     * adresa API-ului pe https://apimtls-mp.cel.ro/, singura care cere certificat.
     *
     * [EN] The certificate is generated from the seller panel (Account >
     * Information > Security) and downloaded ONCE, as a single .pem file holding
     * both the certificate and the private key. Setting it automatically switches
     * the API address to https://apimtls-mp.cel.ro/, the only one requiring it.
     *
     * @param string $path Absolute path to the .pem file on disk
     * @param string|null $passphrase Private key passphrase, when the key is encrypted
     * @throws ResponseException
     */
    public static function setCertificate($path, $passphrase = null)
    {
        // Sanity check
        if (!isset($path) || !is_string($path) || trim($path) === '') {
            throw new ResponseException('Specificati calea catre fisierul .pem al certificatului', ['path' => $path]);
        }

        $path = trim($path);

        if (!is_file($path) || !is_readable($path)) {
            throw new ResponseException('Certificatul nu a fost gasit sau nu poate fi citit: ' . $path, ['path' => $path]);
        }

        self::$CERTIFICATE = $path;
        self::$CERTIFICATE_PASSPHRASE = (isset($passphrase) && $passphrase !== '') ? $passphrase : null;

        // The certificate is only accepted on the mTLS host
        self::$API_HTTP = self::API_HTTP_MTLS;

        // The connection is already built with the previous options, drop it so the
        // certificate is actually presented on the next call
        Dispatcher::resetGuzzleClient();
    }

    /**
     * Guzzle's 'cert' option, or null when no certificate was set
     * @return array|string|null
     */
    public static function getCertificateOption()
    {
        if (empty(self::$CERTIFICATE)) {
            return null;
        }

        if (is_null(self::$CERTIFICATE_PASSPHRASE)) {
            return self::$CERTIFICATE;
        }

        return array(self::$CERTIFICATE, self::$CERTIFICATE_PASSPHRASE);
    }

    // Response timeout
    const TIMEOUT = 30; // 30 seconds

    // Connection timeout
    const CONN_TIMEOUT = 5; // 5 seconds

    // Use test server
    const TEST = true;

    // Maximum number of times Dispatcher is allowed to fail
    const MAX_FAILCOUNT = 10;

    // Sentry reporting DNS
    const SENTRY_DNS = 'https://e25a0133dc72473b96b7aa7b04fdf067@sentry.cel.ro/5';

    // Current version
    const CURRENT_VERSION = '2.0.3';
}
