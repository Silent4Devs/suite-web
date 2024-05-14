<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CuestionarioInfraestructuraTecnologica extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'cuestionario_infraestructura_tecnologica';

    public $fillable = [
        'id',
        'sistemas',
        'aplicativos',
        'base_datos',
        'otro',
        'escenario',
        'cuestionario_id',
    ];

    public function cuestionario()
    {
        return $this->belongsTo(AnalisisImpacto::class, 'cuestionario_id', 'id');
    }
}
