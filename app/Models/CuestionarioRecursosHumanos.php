<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CuestionarioRecursosHumanos extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'cuestionario_recursos_humanos';

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
        return $this->belongsTo(AnalisisImpacto::class, 'cuestionario_id', 'id');
    }
}
