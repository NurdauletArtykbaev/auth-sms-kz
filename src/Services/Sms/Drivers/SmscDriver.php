<?php

namespace App\Services\Base\Sms\Drivers;

use App\Services\Base\Sms\Contracts\SmsDriverInterface;
use App\Services\Base\Sms\Sms;
use Illuminate\Support\Facades\Http;

class SmscDriver implements SmsDriverInterface
{
    protected $url = 'https://smsc.kz/sys/send.php';

    protected $login;
    protected $password;
    protected $senderName;

    public function __construct()
    {
        $this->login = config('sms.smscLogin');
        $this->password = config('sms.smscPassword');
        $this->senderName = config('sms.sender');
    }

    public function send(Sms $sms)
    {
        Http::get($this->url, [
            'login'     => $this->login,
            'psw'       => $this->password,
            'phones'    => $sms->receiver,
            'sender'    => 'Naprocat',
            'from'      => 'Naprocat',
            'mes'       => $sms->text
        ]);

    }
}
