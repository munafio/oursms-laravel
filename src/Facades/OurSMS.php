<?php

namespace Munafio\OurSMS\Facades;

use Illuminate\Support\Facades\Facade;

class OurSMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'oursms';
    }
}