<?php

#remove unicodes from string
function removeUnicodeCharacters($string)
{
    return trim(preg_replace('/[^\x00-\x7F]/u', '', $string));
}
