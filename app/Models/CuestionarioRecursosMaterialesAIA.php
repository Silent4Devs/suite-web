<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CuestionarioRecursosMaterialesAIA extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'recursos_materiales_aia';

    public $fillable = [
        'id',
        'equipos',
        'impresoras',
        'telefono',
        'otro',
        'otro_numero',
        'escenario',
        'cuestionario_id',
    ];
}
