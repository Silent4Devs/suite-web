<?php

namespace App\Http\Requests;

use App\Models\PoliticaSgsi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePoliticaSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('politica_sgsi_edit');
    }

    public function rules()
    {
        return [];
    }
}
