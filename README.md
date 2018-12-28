[![Latest Version on Packagist](https://img.shields.io/packagist/v/7Lab/laravel-kpi.svg?style=flat-square)](https://packagist.org/packages/7Lab/laravel-kpi)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/7Lab/laravel-kpi.svg?style=flat-square)](https://packagist.org/packages/7Lab/laravel-kpi)

# Cache responses
This Laravel package registers some commands which will push a statistic to the specified URL.

## Installation
You can install the package via Composer:
```bash
composer require 7Lab/laravel-kpi
```

The package will automatically register itself.

You can publish the config file with:
```bash
php artisan vendor:publish --provider="SevenLab\Kpi\KpiServiceProvider"
```

This is the contents of the published config file (`config/kpi.php`):
```php
return [

    /*
     * Specify the Autorization Bearer token that will be used for remote KPI.
     */
    'token' => env('KPI_TOKEN'),

    /*
     * Specify the url that will be used for remote KPI.
     */
    'url' => env('KPI_URL'),

];
```

## Usage
The package registers some commands which can be [scheduled](https://laravel.com/docs/scheduling) or can be run [manually](https://laravel.com/docs/artisan) of course. Each command will push a statistic to the specified URL.

### Counting the count of users
Running the command below will push the count of users to `<url>/user-count`.
```bash
php artisan kpi:user-count
```

## Credits
- [Joey Houtenbos](https://github.com/JoeyHoutenbos)
- [All Contributors](https://github.com/7lab/laravel-kpi/contributors)
