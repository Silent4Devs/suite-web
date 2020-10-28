<?php

namespace App\Http\Requests;

use App\Models\AlcanceSgsi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
