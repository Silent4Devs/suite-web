<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MatrizRiesgosSistemaGestionControlesPivot extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    protected $table = 'matriz_riesgos_sistema_gestion_controles_pivot';

    protected $casts = [
        'matriz_id' => 'int',
        'controles_id' => 'int',
    ];

    protected $fillable = [
        'matriz_id',
        'controles_id',
    ];

    public function declaracion_aplicabilidad()
    {
        return $this->belongsTo(DeclaracionAplicabilidad::class, 'controles_id');
    }

    public function matriz_riesgo()
    {
        return $this->belongsTo(MatrizRiesgosSistemaGestion::class, 'matriz_id');
    }
}
