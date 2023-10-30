<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class MatrizOctave.
 *
 * @property int $id
 * @property string|null $vp
 * @property int|null $id_area
 * @property int|null $id_sede
 * @property string|null $servicio
 * @property int|null $id_proceso
 * @property int|null $activo_id
 * @property int|null $operacional
 * @property int|null $cumplimiento
 * @property int|null $legal
 * @property int|null $reputacional
 * @property int|null $tecnologico
 * @property int|null $valor
 * @property int|null $id_analisis
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Area|null $area
 * @property Sede|null $sede
 * @property Proceso|null $proceso
 * @property Activo|null $activo
 * @property AnalisisDeRiesgo|null $analisis_de_riesgo
 */
class MatrizOctave extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'matriz_octave';

    protected $casts = [
        'id_area' => 'int',
        'id_sede' => 'int',
        'id_proceso' => 'int',
        'activo_id' => 'int',
        'operacional' => 'int',
        'cumplimiento' => 'int',
        'legal' => 'int',
        'reputacional' => 'int',
        'tecnologico' => 'int',
        'valor' => 'int',
        'id_analisis' => 'int',
    ];

    protected $fillable = [
        'vp',
        'id_area',
        'id_sede',
        'servicio',
        'id_proceso',
        'activo_id',
        'operacional',
        'cumplimiento',
        'legal',
        'reputacional',
        'tecnologico',
        'valor',
        'id_analisis',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede');
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    public function activo()
    {
        return $this->belongsTo(Activo::class);
    }

    public function analisis_de_riesgo()
    {
        return $this->belongsTo(AnalisisDeRiesgo::class, 'id_analisis');
    }

    public function matriz_octave_controles_pivots()
    {
        return $this->hasMany(MatrizOctaveControlesPivot::class, 'id_octave');
    }

    public function matrizActivos()
    {
        return $this->hasMany(MatrizoctaveActivosInfo::class, 'id_octave', 'id');
    }
}
