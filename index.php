<?php

/**
 * Dependencies autoloader
 */
include __DIR__ . '/vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use celmarket\Auth;
use celmarket\Config;

/**
 * [RO] Autentificare prin certificat de client (mTLS) - optionala
 *      Certificatul se genereaza din panoul de vanzator, sectiunea
 *      Cont > Informatii > Securitate, si se descarca O SINGURA DATA:
 *      un singur fisier .pem, care contine si certificatul si cheia privata.
 *      Apelul de mai jos comuta automat adresa API-ului pe
 *      https://apimtls-mp.cel.ro/, singura care cere certificat.
 *
 * [EN] Client certificate (mTLS) authentication - optional
 *      Generate the certificate from the seller panel, under
 *      Account > Information > Security, and download it ONCE: a single .pem
 *      file holding both the certificate and the private key.
 *      The call below automatically switches the API address to
 *      https://apimtls-mp.cel.ro/, the only one requiring it.
 */
//Config::setCertificate('/path/to/xplm.pem');

// [RO] Daca cheia privata are parola | [EN] If the private key has a passphrase
//Config::setCertificate('/path/to/xplm.pem', 'parola-cheii');

Auth::setUserDetails('XXXX', 'XXXX');
