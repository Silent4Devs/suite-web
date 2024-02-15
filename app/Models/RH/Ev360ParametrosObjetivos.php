<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ev360ParametrosObjetivos extends Model
{
    use HasFactory;

    protected $table = "ev360_parametros_objetivos";

    protected $fillable = [
        'evaluacion_id',
        'parametro',
        'valor',
        'color',
        'descripcion',
    ];
}
