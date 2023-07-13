<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

/**
 * Class Proceso.
 *
 * @property int $id
 * @property string|null $codigo
 * @property string|null $nombre
 * @property int|null $id_macroproceso
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Macroproceso|null $macroproceso
 * @property Collection|IndicadoresSgsi[] $indicadores_sgsis
 */
class Proceso extends Model
{
    use SoftDeletes;
    protected $table = 'procesos';

    protected $casts = [
        'id_macroproceso' => 'int',
    ];

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const ACTIVO = '1';
    const NO_ACTIVO = '2';

    protected $appends = ['name', 'content', 'proceso_octave_riesgo', 'color'];

    protected $fillable = [
        'codigo',
        'nombre',
        'id_macroproceso',
        'descripcion',
        'estatus',
        'documento_id',

    ];

    public function getColorAttribute()
    {
        if (intval($this->proceso_octave_riesgo) <= 5) {
            return '#0C7000';
        } elseif (intval($this->proceso_octave_riesgo) <= 20) {
            return '#2BE015';
        } elseif (intval($this->proceso_octave_riesgo) <= 50) {
            return '#FFFF00';
        } elseif (intval($this->proceso_octave_riesgo) <= 80) {
            return '#FF7000';
        } else {
            return '#FF0000';
        }
    }

    #Redis methods
    public static function getAll($columns = ['id', 'codigo', 'nombre'])
    {
        return Cache::remember('procesos_all', 3600 * 24, function () use ($columns) {
            return self::select($columns)->get();
        });
    }

    public function getProcesoOctaveRiesgoAttribute()
    {
        return $this->procesoOctave ? $this->procesoOctave->nivel_riesgo : 0;
    }

    public function getNameAttribute()
    {
        return $this->codigo . ' ' . $this->nombre;
    }

    public function getContentAttribute()
    {
        return Str::limit($this->descripcion, 20, '...') ? Str::limit($this->descripcion, 20, '...') : 'Sin Contenido';
    }

    public function macroproceso()
    {
        return $this->belongsTo(Macroproceso::class, 'id_macroproceso');
    }

    public function indicadores_sgsis()
    {
        return $this->hasMany(IndicadoresSgsi::class, 'id_proceso');
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class, 'documento_id', 'id');
    }

    public function vistaDocumento()
    {
        return $this->belongsToMany(Documento::class);
    }

    public function macro()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function activosAI()
    {
        return $this->hasMany(ActivoInformacion::class, 'proceso_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(ActivoInformacion::class, 'proceso_id', 'id')->with('children');
    }

    public function procesoOctave()
    {
        return $this->hasOne(MatrizOctaveProceso::class, 'id_proceso', 'id');
    }

    public function procesosOctave()
    {
        return $this->hasMany(MatrizOctaveProceso::class, 'id_proceso', 'id');
    }
}
