<?php

namespace App\Http\Requests;

use App\Models\Minutasaltadireccion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMinutasaltadireccionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('minutasaltadireccion_create');
    }

    public function rules()
    {
        return [
            'arearesponsable' => [
                'string',
                'nullable',
            ],
            'fechareunion'    => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
