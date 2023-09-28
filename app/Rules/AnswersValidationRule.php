<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AnswersValidationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Datos del new
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
        $exist_is_correct_checked = false;
        foreach ($value as $answer) {
            if ($answer['is_correct'] != false) {
                $exist_is_correct_checked = true;
                break;
            }
        }

        // dd($exist_is_correct_checked);
        return $exist_is_correct_checked;
        // dd($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Debe existir al menos una respuesta correcta.';
    }
}
