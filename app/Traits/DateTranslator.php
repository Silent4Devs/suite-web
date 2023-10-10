<?php

namespace App\Traits;

use Jenssegers\Date\Date;

trait DateTranslator
{
    public function getCreatedAtAttribute($date)
    {
        Date::setLocale('es');

        return new Date($date);
    }

    public function getUpdatedAtAttribute($date)
    {
        Date::setLocale('es');

        return new Date($date);
    }
}
