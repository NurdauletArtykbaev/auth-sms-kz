<?php

namespace App\Services\Base\Sms\Drivers;

use App\Services\Base\Sms\Contracts\SmsDriverInterface;
use App\Services\Base\Sms\Sms;
use Illuminate\Support\Facades\Http;

class MobizonDriver implements SmsDriverInterface
{
    const BASE_URL = 'https://api.mobizon.kz';

    protected $apiKey;
    protected $senderName;

    public function __construct()
    {
        $this->apiKey = config('sms.mobizon_key');
        $this->senderName = config('sms.sender');
    }

    public function send(Sms $sms)
    {
        $body = [
            'recipient' => $sms->receiver,
            'text' => $sms->text,
            'from' => $this->senderName,
        ];
        $url = self::BASE_URL."/service/message/sendSmsMessage?output=json&api=v1&apiKey={$this->apiKey}";

        return Http::withHeaders(["content-type" => "application/x-www-form-urlencoded"])
            ->post($url, $body)
            ->json();
    }
}
