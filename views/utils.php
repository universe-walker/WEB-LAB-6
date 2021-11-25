<?php

function get_short_string($string)
{
    return mb_strimwidth($string, 0, 240, '...');
}
