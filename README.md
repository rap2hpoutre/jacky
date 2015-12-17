# Jacky

[![Packagist](https://img.shields.io/packagist/v/rap2hpoutre/jacky.svg)]()
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/scrutinizer/build/g/rap2hpoutre/jacky.svg?style=flat-square)](https://travis-ci.org/rap2hpoutre/jacky)
[![Quality Score](https://img.shields.io/scrutinizer/g/rap2hpoutre/jacky.svg?style=flat-square)](https://scrutinizer-ci.com/g/jacky/nestor)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/27adcd2f-20de-4555-8753-3ece7ee24495/mini.png)](https://insight.sensiolabs.com/projects/27adcd2f-20de-4555-8753-3ece7ee24495)

JSON API Client for Laravel and Lumen. It's basically just a [Guzzle](https://github.com/guzzle/guzzle) wrapper for JSON, because Guzzle [does not care](http://stackoverflow.com/questions/30530172/guzzle-6-no-more-json-method-for-responses) about JSON anymore. And you can configure your endpoints once and for all in a [configuration file](https://github.com/rap2hpoutre/jacky/blob/master/src/config.php), could be useful if you work with different services.
## Install

Install via composer
```
composer require rap2hpoutre/jacky
```
Add Service Provider to `config/app.php` in `providers` section
```php
Rap2hpoutre\Jacky\ServiceProvider::class,
```

Then add the facade in `aliases` section (optional) 
```php
'Jacky' => Rap2hpoutre\Jacky\Facade::class,
```

Publish configuration
```
php artisan vendor:publish
```

## Usage

### Simple example
Let's say foo API returns this on `GET /users/1`: 
```json
{
  "data": [{
    "name": "John Doe",
    "email": "john@example.com"
  }]
}
```

You may get the user like this:
```php
$user_name = Jacky::get('foo', '/users/1')->data->first()->name;
```

### Not found example
Let's say foo API returns this on `GET /users/2` not found: 
```json
{
  "errors": [{
    "status": "404",
    "title":  "User not found :/"
  }]
}
```

You may display error title like this:
```php
use Rap2hpoutre\Jacky\Exception\Http404Exception;

try {
    $user = Jacky::get('foo', '/users/1');
} catch (Http404Exception $e) {
    echo $e->errors->first()->title;
}

```

## Configuration
You can learn more about configuration [here](https://github.com/rap2hpoutre/jacky/blob/master/src/config.php)
