<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametrosEvaluacionAnalisisBrechas extends Model
{
    use HasFactory;

    public $table = 'parametros_evaluacion_analisis_brechas';

    public $fillable = [
        'evaluacion_id',
        'estatus',
        'color',
        'valor',
        'descripcion',
    ];
}
