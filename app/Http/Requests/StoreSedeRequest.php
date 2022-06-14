<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreSedeRequest extends FormRequest
{
  

    public function rules()
    {
        return [
            'sede' => [
                'string',
                'required',
            ],
        ];
    }
}
