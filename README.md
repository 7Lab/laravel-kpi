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
     * Specify the Autorization Bearer token that will be used.
     */
    'token' => env('LAB_TOKEN'),

    /*
     * Specify the base url that will be used.
     */
    'url' => env('LAB_BASE_URL'),

    /*
     * Specify the endpoint that will be used for the KPI stats.
     */
    'endpoint' => env('KPI_ENDPOINT', ''),

    /**
     * Define the number of days we will threat as being 'active'
     */
    'active_period' => 7,

    /**
     * Database columns for the user counts
     */
    'users_table_name' => env('KPI_USERS_TABLE_NAME', 'users'),

    /*
     * Specify the last login column name.
     */
    'last_login_column_name' => env('KPI_LAST_LOGIN_COLUMN', 'last_login_at'),

    /**
     * Enable or disable the stats.
     */
    'stats_enabled' => env('KPI_ENABLE_STATS', false),
];
```

Run ```php artisan migrate``` to run the migrations for ```last_login_at``` which allows the count of active users.

## Usage
The package registers some commands which can be [scheduled](https://laravel.com/docs/scheduling) or can be run [manually](https://laravel.com/docs/artisan) of course. Each command will push a statistic to the specified URL.

### Counting the count of users
Running the command below will push the count of total amount users to the kpi-endpoint.
```bash
php artisan kpi:total-user-count
```

Running the command below will push the count of total active users to the kpi-endpoint.
```bash
php artisan kpi:active-user-count
```

Running the command below will push the count of total deleted users to the kpi-endpoint.
```bash
php artisan kpi:deleted-user-count
```

These commands will run weekly on sunday 12am.
## Credits
- [Joey Houtenbos](https://github.com/JoeyHoutenbos)
- [All Contributors](https://github.com/7lab/laravel-kpi/contributors)
