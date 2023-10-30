<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CuestionarioInfraestructuraTecnologica extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
