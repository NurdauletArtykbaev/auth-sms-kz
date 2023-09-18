<?php

namespace App\Services\Base\Sms;

use App\Services\Base\Sms\Contracts\SmsDriverInterface;
use App\Services\Base\Sms\Drivers\SmscDriver;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{

    public $bindings = [
//        SmsDriverInterface::class => MobizonDriver::class
        SmsDriverInterface::class => SmscDriver::class
    ];

    public function register()
    {
        $this->app->bind('sms_service', SmsService::class);
    }
}
