<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobadorSeleccionado extends Model
{
    use HasFactory;

    protected $table = 'aprobador_seleccionados';

    protected $fillable = [
        'modulo_id',
        'submodulo_id',
        'user_id',
        'seguridad_id',
        'mejoras_id',
        'riesgos_id',
        'sugerencias_id',
        'quejas_id',
        'denuncias_id',
        'aprobadores',
    ];
}
