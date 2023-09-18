<?php

namespace App\Services\Base\Sms;

use App\Services\Base\Sms\Contracts\SmsDriverInterface;

class SmsService
{

    public function __construct(private SmsDriverInterface $driver)
    {
    }

    public function to(string $receiver = null): Sms
    {
        return new Sms($receiver);
    }

    public function __call($method, array $parameters = [])
    {
        return $this->driver->{$method}(...$parameters);
    }
}
