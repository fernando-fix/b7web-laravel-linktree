<?php

use App\Services\Alert;

if (!function_exists('alert')) {
    function alert()
    {
        return new Alert();
    }
}
