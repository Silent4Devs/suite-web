<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CuestionarioRecursosMateriales extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'cuestionario_recursos_materiales';

    public $fillable = [
        'id',
        'equipos',
        'impresoras',
        'telefono',
        'otro',
        'escenario',
        'cuestionario_id',
    ];
}
