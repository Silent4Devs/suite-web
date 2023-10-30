<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class OportunidadesEntendimientoOrganizacion.
 *
 * @property int $id
 * @property string|null $oportunidad
 * @property string|null $riesgo
 * @property int|null $foda_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property EntendimientoOrganizacion|null $entendimiento_organizacion
 */
class OportunidadesEntendimientoOrganizacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'oportunidades_entendimiento_organizacion';

    protected $casts = [
        'foda_id' => 'int',
    ];

    protected $fillable = [
        'oportunidad',
        'riesgo',
        'foda_id',
    ];

    protected $appends = ['tiene_riesgos_asociados'];

    public function entendimiento_organizacion()
    {
        return $this->belongsTo(EntendimientoOrganizacion::class, 'foda_id');
    }

    public function riesgos()
    {
        return $this->morphToMany(MatrizRiesgo::class, 'riesgosable', null, null, 'riesgos_id');
    }

    public function getTieneRiesgosAsociadosAttribute()
    {
        $tiene_riesgos = false;

        if (count($this->riesgos) > 0) {
            $tiene_riesgos = true;
        }

        return $tiene_riesgos;
    }
}
