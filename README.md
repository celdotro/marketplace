# marketplace
CEL.ro Marketplace API wrapper in PHP

___

## Documentation
> [https://github.com/celdotro/marketplace/wiki](https://github.com/celdotro/marketplace/wiki)
___
## Install 

### Using composer CLI
>Command
```
composer require celdotro/marketplace
```

### Using composer.json
>composer.json
```
{  
    "require": {  
        "celdotro/marketplace": "*"
    },
    "minimum-stability": "dev",
    "prefer-stable": true
}
```

>Command
```
composer install
```
___
## Configure
Call **Auth::setUserDetails** with the supplied user name and password before any other method of the API
```
use celmarket\Auth;
Auth::setUserDetails('USERNAME', 'PASSWORD');
```
___
## Packagist
https://packagist.org/packages/celdotro/marketplace