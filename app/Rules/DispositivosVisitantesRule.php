<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DispositivosVisitantesRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $passes = true;
        foreach ($value as $dispositivo) {
            if ($dispositivo['dispositivo'] == '' && $dispositivo['serie'] == '') {
                $passes = true;
            } else {
                $passes = false;
            }
        }

        return $passes;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
