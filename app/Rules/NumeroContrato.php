<?php

namespace App\Rules;

use App\Models\Katbol\Contrato;
use Illuminate\Contracts\Validation\Rule;

class NumeroContrato implements Rule
{
    public $id_contrato;

    public function __construct($id_contrato = null)
    {
        $this->id_contrato = $id_contrato;
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
        if ($this->id_contrato != null) {
            $id_contrato = $this->id_contrato;
            $no_contrato = $value;
            $pertenece_no_contrato_editable = Contrato::where('id', '=', $id_contrato)->where('no_contrato', '=', $no_contrato)->exists();
            $existe_numero_contrato = Contrato::where('no_contrato', '=', $no_contrato)->exists();
            if ($pertenece_no_contrato_editable) {
                if ($existe_numero_contrato) {
                    //dd($pertenece_no_contrato_editable);
                    return true;
                } else {
                    return true;
                }
            } else {
                if ($existe_numero_contrato) {
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            $no_contrato = $value;
            $existe_numero_contrato = Contrato::where('no_contrato', '=', $no_contrato)->exists();

            if ($existe_numero_contrato) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El número de contrato ya existe';
    }
}
