<?php

namespace NurdauletArtykbaev\CoreAuth\Facades;

use Illuminate\Support\Facades\Facade;

class SMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sms_service';
    }
}
