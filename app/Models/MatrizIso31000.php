<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class MatrizIso31000.
 *
 * @property int $id
 * @property string|null $proveedores
 * @property string|null $servicio
 * @property int|null $id_proceso
 * @property string|null $descripcion_servicio
 * @property int|null $estrategico
 * @property int|null $operacional
 * @property int|null $cumplimiento
 * @property int|null $legal
 * @property int|null $reputacional
 * @property int|null $tecnologico
 * @property int|null $valor
 * @property int|null $id_analisis
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Proceso|null $proceso
 * @property AnalisisDeRiesgo|null $analisis_de_riesgo
 */
class MatrizIso31000 extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    protected $table = 'matriz_iso31000';

    protected $casts = [
        'id_proceso' => 'int',
        'estrategico' => 'int',
        'operacional' => 'int',
        'cumplimiento' => 'int',
        'legal' => 'int',
        'reputacional' => 'int',
        'tecnologico' => 'int',
        'valor' => 'int',
        'id_analisis' => 'int',
    ];

    protected $fillable = [
        'proveedores',
        'servicio',
        'id_proceso',
        'descripcion_servicio',
        'estrategico',
        'operacional',
        'cumplimiento',
        'legal',
        'reputacional',
        'tecnologico',
        'valor',
        'id_analisis',
    ];

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    public function analisis_de_riesgo()
    {
        return $this->belongsTo(AnalisisDeRiesgo::class, 'id_analisis');
    }

    public function activosInformacion()
    {
        return $this->hasMany(Matriz31000ActivosInfo::class, 'id_matriz31000', 'id');
    }
}
