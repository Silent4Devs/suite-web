<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class MatrizRiesgosControlesPivot.
 *
 * @property int $id
 * @property int $matriz_id
 * @property int $controles_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property DeclaracionAplicabilidad $declaracion_aplicabilidad
 * @property MatrizRiesgo $matriz_riesgo
 */
class MatrizRiesgosControlesPivot extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    protected $table = 'matriz_riesgos_controles_pivot';

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
        return $this->belongsTo(MatrizRiesgo::class, 'matriz_id');
    }
}
