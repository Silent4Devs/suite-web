<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CuestionarioRecursosHumanosAIA extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'recursos_humanos_aia';

    public $fillable = [
        'id',
        'empresa',
        'nombre',
        'a_paterno',
        'a_materno',
        'puesto',
        'rol',
        'tel',
        'correo',
        'escenario',
        'cuestionario_id',
    ];

    public function cuestionario()
    {
        return $this->belongsTo(AnalisisAIA::class, 'cuestionario_id', 'id');
    }
}
