<?php

namespace App\Functions;

class CountriesFunction
{
    /**
     * @param  string  $language
     *
     * @options 'ES', 'EN'
     */
    public function getCountries($language = 'ES')
    {
        switch ($language) {
            case 'ES':
                $countries = $this->getCountriesSpanish();

                return $countries;
                break;
            case 'EN':
                $countries = $this->getCountriesEnglish();

                return $countries;
                break;
            default:
                $countries = $this->getCountriesSpanish();

                return $countries;
                break;
        }
    }

    public function getCountriesSpanish()
    {
        $countries = collect(json_decode(file_get_contents(public_path('world-countries/data/es/world.json'))));
        $flagsCountries = collect(json_decode(file_get_contents(public_path('world-countries/flags/64x64/flags-64x64.json'))));

        for ($i = 0; $i < count($countries); $i++) {
            $code = $countries[$i]->alpha2;
            $flag = $flagsCountries->filter(function ($item, $key) use ($code) {
                return $key == $code;
            })->first();
            $countries[$i]->flag = $flag;
        }

        return $countries;
    }

    public function getCountriesEnglish()
    {
        $countries = collect(json_decode(file_get_contents(public_path('world-countries/data/en/world.json'))));
        $flagsCountries = collect(json_decode(file_get_contents(public_path('world-countries/flags/64x64/flags-64x64.json'))));

        for ($i = 0; $i < count($countries); $i++) {
            $code = $countries[$i]->alpha2;
            $flag = $flagsCountries->filter(function ($item, $key) use ($code) {
                return $key == $code;
            })->first();
            $countries[$i]->flag = $flag;
        }

        return $countries;
    }
}
