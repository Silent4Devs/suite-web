<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAreaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'area' => [
                'string',
                'nullable',
            ],
        ];
    }
}
