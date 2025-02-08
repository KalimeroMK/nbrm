# Laravel NBRM Package

## Description
The `kalimeromk/nbrm` package provides a Laravel service for retrieving exchange rates from the **National Bank of the Republic of Macedonia (NBRM)**. The package allows users to fetch daily exchange rates and exchange rates for government institutions.

## Installation
To install the package, use composer:

```bash
composer require kalimeromk/nbrm
```

## Configuration
Publish the package configuration:

```bash
php artisan vendor:publish --tag=config --provider="Kalimeromk\Nbrm\NBRMExchangeServiceProvider"
```

Then, update your `.env` file with the API base URL:

```env
NBRM_BASE_URL=https://www.nbrm.mk/KLServiceNOV/
NBRM_FORMAT=json
```

## Usage
Import the facade in your Laravel project:

```php
use Kalimeromk\Nbrm\Facades\NBRMExchange;
```

### Get Exchange Rate
```php
$response = NBRMExchange::getExchangeRate('01.02.2024', '08.02.2024');
print_r($response);
```

### Get Exchange Rate (Detailed Format)
```php
$response = NBRMExchange::getExchangeRateD('01-Feb-2024', '08-Feb-2024');
print_r($response);
```

### Get Exchange Rates (All Currencies)
```php
$response = NBRMExchange::getExchangeRates('01.02.2024', '08.02.2024');
print_r($response);
```

### Get Exchange Rates (Detailed Format)
```php
$response = NBRMExchange::getExchangeRatesD('01-Feb-2024', '08-Feb-2024');
print_r($response);
```

## Testing
Run the PHPUnit tests to verify that the package works correctly:

```bash
vendor/bin/phpunit
```

## License
This package is open-sourced software licensed under the **MIT License**.
