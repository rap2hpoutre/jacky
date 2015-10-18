# Hjac
Heroic Json API Client for Laravel
## Install

Install via composer
```
composer require rap2hpoutre/hjac
```
Add Service Provider to `config/app.php` in `providers` section
```php
Rap2hpoutre\Hjac\ServiceProvider::class,
```

Then add the facade in `aliases` section
```php
'Hjac' => Rap2hpoutre\Hjac\Facade::class,
```

Publish configuration in order to use Slack alerts
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

You may get your user like this:
```php
$user_name = Hjac::get('foo', '/users/1')->data->first()->name;
```

### Not found example
And it returns this on `GET /users/2` not found: 
```json
{
  "errors": [{
    "status": "404",
    "title":  "User not found :/"
  }]
}
```

You may get your user like this:
```php
use Rap2hpoutre\Hjac\Exception\Http404Exception;

try {
    $user = Hjac::get('foo', '/users/1');
} catch (Http404Exception $e) {
    echo $e->errors->first()->title;
}

```
