<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NecesidadExpectativaNorma extends Model
{
    protected $table = 'normas_nececidades_expectativas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_norma',
        'id_necesidad_expectativa',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
