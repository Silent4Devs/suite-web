<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAlcanceSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('alcance_sgsi_edit');
    }

    public function rules()
    {
        return [];
    }
}
