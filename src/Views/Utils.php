<?php

namespace App\Views;

class Utils
{
    public static function get_short_string($string)
    {
        return mb_strimwidth($string, 0, 240, '...');
    }
}
