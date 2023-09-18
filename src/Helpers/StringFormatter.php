<?php

use NurdauletArtykbaev\CoreAuth\Helpers;

class StringFormatter
{


    public static function onlyDigits($str)
    {
        return preg_replace('/[^0-9]/', '', $str);
    }
}