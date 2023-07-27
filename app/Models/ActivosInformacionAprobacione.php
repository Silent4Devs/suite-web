<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ActivosInformacionAprobacione.
 *
 * @property int $id
 * @property bool $aceptado
 * @property int $persona_califico_id
 * @property int $activoInformacion_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Empleado $empleado
 * @property ActivosInformacion $activos_informacion
 */
class ActivosInformacionAprobacione extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'activos_informacion_aprobaciones';

    protected $casts = [
        'aceptado' => 'bool',
        'persona_califico_id' => 'int',
        'activoInformacion_id' => 'int',
    ];

    protected $fillable = [
        'aceptado',
        'persona_califico_id',
        'activoInformacion_id',
        'carta_aceptacion_aprobacion_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'persona_califico_id')->alta();
    }

    public function activos_informacion()
    {
        return $this->belongsTo(ActivoInformacion::class, 'activoInformacion_id');
    }

    public function cartaAceptacionAprobacion()
    {
        return $this->belongsTo(CartaAceptacionAprobacione::class, 'carta_aceptacion_aprobacion_id');
    }
}
