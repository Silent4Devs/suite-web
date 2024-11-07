<?php

use App\PloiManager;

//remove unicodes from string
function removeUnicodeCharacters($string)
{
    return trim(preg_replace('/[^\x00-\x7F]/u', '', $string));
}


if (! function_exists('ploi')) {
    function ploi(): PloiManager
    {
        return app(PloiManager::class);
    }
}
