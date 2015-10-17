# Laravel Rest API Client

## Install

Install via composer
```
composer require rap2hpoutre/laravel-http-client
```
Add Service Provider to `config/app.php` in `providers` section
```php
Rap2hpoutre\HttpClient\ServiceProvider::class,
```

Then add the facade in `aliases` section
```php
'HttpClient' => Rap2hpoutre\HttpClient\Facade::class,
```

Publish configuration in order to use Slack alerts
```php
php artisan vendor:publish
```
