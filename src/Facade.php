<?php namespace Rap2hpoutre\Jacky;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return 'jacky';
    }
}
