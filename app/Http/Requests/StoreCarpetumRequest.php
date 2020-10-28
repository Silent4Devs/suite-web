<?php

namespace App\Http\Requests;

use App\Models\Carpetum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCarpetumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('carpetum_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'nullable',
            ],
        ];
    }
}
