<?php

namespace Nurdaulet\AuthSmsKz\Http\Requests;

class VerifyOtpRequest extends PhoneNumberRequest
{

    public function rules()
    {
        return array_merge(parent::rules(), [
            'code' => 'required|min:4'
        ]);
    }
}
