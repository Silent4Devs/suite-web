<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MonthAfterOrEqual implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $inicio;

    public $fin;

    public function __construct($inicio, $fin)
    {
        $this->inicio = $inicio;
        $this->fin = $fin;
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
        if ($this->inicio == null || $this->fin == null) {
            return true;
        }
        $fechaInicio = explode(' ', $this->inicio);
        $mesInicio = $this->getNumberMonth($fechaInicio[0]);
        $yearInicio = (int) $fechaInicio[1];
        $fechaFin = explode(' ', $this->fin);
        $mesFin = $this->getNumberMonth($fechaFin[0]);
        $yearFin = (int) $fechaFin[1];

        if ($yearFin > $yearInicio) {
            return true;
        } elseif ($yearFin < $yearInicio) {
            return false;
        } else {
            if ($mesFin >= $mesInicio) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function getNumberMonth($month)
    {
        if ($month == 'Enero') {
            return 1;
        }
        if ($month == 'Febrero') {
            return 2;
        }
        if ($month == 'Мarzo') {
            return 3;
        }
        if ($month == 'Abril') {
            return 4;
        }
        if ($month == 'Mayo') {
            return 5;
        }
        if ($month == 'Junio') {
            return 6;
        }
        if ($month == 'Julio') {
            return 7;
        }
        if ($month == 'Agosto') {
            return 8;
        }
        if ($month == 'Septiembre') {
            return 9;
        }
        if ($month == 'Octubre') {
            return 10;
        }
        if ($month == 'Noviembre') {
            return 11;
        }
        if ($month == 'Diciembre') {
            return 12;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La finalización debe de ser mayor o igual a la inicial';
    }
}
