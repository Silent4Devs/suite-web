<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ParametrosEvaluacionAnalisisBrechas extends Model implements Auditable
{
    use HasFactory;
    use  \OwenIt\Auditing\Auditable;

    public $table = 'parametros_evaluacion_analisis_brechas';

    public $fillable = [
        'evaluacion_id',
        'estatus',
        'color',
        'valor',
        'descripcion',
    ];
}