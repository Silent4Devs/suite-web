<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ProcesosActivosInformacion.
 *
 * @property int $id
 * @property int|null $losprocesos_id
 * @property int|null $id_activos_informacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Proceso|null $proceso
 * @property ActivosInformacion|null $activos_informacion
 */
class ProcesosActivosInformacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'procesos_activos_informacion';

    protected $casts = [
        'losprocesos_id' => 'int',
        'id_activos_informacion' => 'int',
    ];

    protected $fillable = [
        'losprocesos_id',
        'id_activos_informacion',
    ];

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'losprocesos_id');
    }

    public function activos_informacion()
    {
        return $this->belongsTo(ActivosInformacion::class, 'id_activos_informacion');
    }
}
