<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CuestionarioRecursosMaterialesAIA extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
