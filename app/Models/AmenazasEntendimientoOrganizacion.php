<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AmenazasEntendimientoOrganizacion.
 *
 * @property int $id
 * @property string|null $amenaza
 * @property string|null $riesgo
 * @property int|null $foda_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property EntendimientoOrganizacion|null $entendimiento_organizacion
 */
class AmenazasEntendimientoOrganizacion extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    protected $table = 'amenazas_entendimiento_organizacion';

    protected $casts = [
        'foda_id' => 'int',
    ];

    protected $fillable = [
        'amenaza',
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
