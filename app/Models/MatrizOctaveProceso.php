<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MatrizOctaveProceso.
 *
 * @property int $id
 * @property int|null $id_proceso
 * @property int|null $nivel_riesgo
 * @property int|null $id_direccion
 * @property int|null $servicio_id
 * @property int|null $operacional
 * @property int|null $cumplimiento
 * @property int|null $legal
 * @property int|null $reputacional
 * @property int|null $tecnologico
 * @property int|null $impacto
 * @property int|null $id_activos_informacion
 * @property int|null $promedio
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Proceso|null $proceso
 * @property Grupo|null $grupo
 * @property MatrizOctaveServicio|null $matriz_octave_servicio
 * @property ActivosInformacion|null $activos_informacion
 */
class MatrizOctaveProceso extends Model
{
    protected $table = 'matriz_octave_procesos';

    protected $casts = [
        'id_proceso' => 'int',
        'nivel_riesgo' => 'int',
        'id_direccion' => 'int',
        'servicio_id' => 'int',
        'operacional' => 'int',
        'cumplimiento' => 'int',
        'legal' => 'int',
        'reputacional' => 'int',
        'tecnologico' => 'int',
        'impacto' => 'int',
        'id_activos_informacion' => 'int',
        'promedio' => 'int',
    ];

    protected $fillable = [
        'id_proceso',
        'nivel_riesgo',
        'id_direccion',
        'servicio_id',
        'operacional',
        'cumplimiento',
        'legal',
        'reputacional',
        'tecnologico',
        'impacto',
        'id_activos_informacion',
        'promedio',
    ];

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_direccion');
    }

    public function servicio()
    {
        return $this->belongsTo(MatrizOctaveServicio::class, 'servicio_id');
    }

    public function activos_informacion()
    {
        return $this->belongsTo(ActivosInformacion::class, 'id_activos_informacion');
    }
}
