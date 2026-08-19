# CEL.ro: Marketplace
**CEL.ro Marketplace API wrapper in PHP**  
  
[![Latest Stable Version](https://poser.pugx.org/celdotro/marketplace/v/stable?format=flat-square)](https://packagist.org/packages/celdotro/marketplace)
[![Total Downloads](https://poser.pugx.org/celdotro/marketplace/downloads?format=flat-square)](https://packagist.org/packages/celdotro/marketplace)
[![License](https://poser.pugx.org/celdotro/marketplace/license)](https://packagist.org/packages/celdotro/marketplace)
[![Latest Unstable Version](https://poser.pugx.org/celdotro/marketplace/v/unstable?format=flat-square)](https://packagist.org/packages/celdotro/marketplace#dev-master)

[![GitHub issues](https://img.shields.io/github/issues/celdotro/marketplace.svg?style=flat-square)](https://github.com/celdotro/marketplace/issues)
[![GitHub stars](https://img.shields.io/github/stars/celdotro/marketplace.svg?style=flat-square)](https://github.com/celdotro/marketplace/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/celdotro/marketplace.svg?style=flat-square)](https://github.com/celdotro/marketplace/network)

## Requirements
#### API Wrapper 2.x
PHP >= 7.2.5

#### API Wrapper 1.x
PHP >= 5.6

**[RO]** Daca sunteti interesati de crearea unui cont de testare, va rugam sa ne contactati la: **mp [_ AT _] cel.ro**  
**[EN]** If you are interested in creating an account for testing purposes, please contact us at: **mp [_ AT _] cel.ro**
___
## [RO] Postman
Pentru informatii referitoare la Postman, accesati: [https://github.com/celdotro/marketplace/wiki/PostmanRO](https://github.com/celdotro/marketplace/wiki/PostmanRO)

## [EN] Postman
For information regarding Postman, access: [https://github.com/celdotro/marketplace/wiki/PostmanEN](https://github.com/celdotro/marketplace/wiki/PostmanEN)
___
## [RO + EN] WIKI
[RO] Pentru a consulta documentatia, vizitati pagina de mai jos:  
[EN] In order to read the documentation, visit the link below:  
> [https://github.com/celdotro/marketplace/wiki](https://github.com/celdotro/marketplace/wiki)
___ 
## [RO] Instructiuni de instalare si configurare | [EN] Install and configure instructions

> [RO] [https://github.com/celdotro/marketplace/wiki/Instalare](https://github.com/celdotro/marketplace/wiki/Instalare)

> [EN] [https://github.com/celdotro/marketplace/wiki/Install](https://github.com/celdotro/marketplace/wiki/Install)
___
## [RO] Informatii generale | [EN] General information
> [RO] [https://github.com/celdotro/marketplace/wiki/Informatii-generale](https://github.com/celdotro/marketplace/wiki/Informatii-generale)

> [EN] [https://github.com/celdotro/marketplace/wiki/General-Information](https://github.com/celdotro/marketplace/wiki/General-Information)
___
## [RO] Autentificare prin certificat de client (mTLS) | [EN] Client certificate (mTLS) authentication

**[RO]** Certificatul se genereaza din panoul de vanzator, sectiunea **Cont > Informatii > Securitate**, si se descarca **o singura data**: un singur fisier `.pem` care contine si certificatul si cheia privata. Cheia privata nu se stocheaza la noi si nu se poate recupera - daca o pierdeti, generati alt certificat (cel precedent se revoca instant).

**[EN]** Generate the certificate from the seller panel, under **Account > Information > Security**, and download it **once**: a single `.pem` file holding both the certificate and the private key. The private key is not stored on our side and cannot be recovered - if you lose it, generate a new certificate (the previous one is revoked instantly).

```php
use celmarket\Auth;
use celmarket\Config;

// [RO] Calea fizica catre certificat | [EN] Filesystem path to the certificate
Config::setCertificate('/path/to/cel-mp-12345-20260819.pem');

// [RO] Daca cheia privata are parola | [EN] If the private key has a passphrase
// Config::setCertificate('/path/to/cel-mp-12345-20260819.pem', 'parola-cheii');

Auth::setUserDetails('username', 'password');
```

**[RO]** `setCertificate` comuta automat adresa API-ului de pe `https://api-mp.cel.ro/` pe **`https://apimtls-mp.cel.ro/`**, singura care cere certificat. Apelati-l inainte de `Auth::setUserDetails`.

**[EN]** `setCertificate` automatically switches the API address from `https://api-mp.cel.ro/` to **`https://apimtls-mp.cel.ro/`**, the only one requiring a certificate. Call it before `Auth::setUserDetails`.

| | |
|---|---|
| [RO] Adresa standard / [EN] Standard address | `https://api-mp.cel.ro/market_api/` |
| [RO] Adresa cu certificat / [EN] Certificate address | `https://apimtls-mp.cel.ro/market_api/` |
| [RO] Valabilitate certificat / [EN] Certificate validity | 90 [RO] zile / [EN] days |

___
## Packagist
[https://packagist.org/packages/celdotro/marketplace](https://packagist.org/packages/celdotro/marketplace)
___
## Github
[https://github.com/celdotro/marketplace](https://github.com/celdotro/marketplace)
___
## Contact
> dp [_ AT _] cel.ro
