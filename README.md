# Jacky
JSON API Client for Laravel and Lumen
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
