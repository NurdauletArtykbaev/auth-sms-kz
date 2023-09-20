<?php

namespace Nurdaulet\AuthSmsKz\Helpers;

class StringFormatterHelper
{


    public static function onlyDigits($str)
    {
        return preg_replace('/[^0-9]/', '', $str);
    }
}