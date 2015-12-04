<?php namespace Rap2hpoutre\HttpClient;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return 'http-client';
    }
}
