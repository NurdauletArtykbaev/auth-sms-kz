<?php

namespace App\Services\Base\Sms\Contracts;

use App\Services\Base\Sms\Sms;

interface SmsDriverInterface
{
    public function send(Sms $sms);
}
