<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

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
 * @property Macroproceso|null $macroproceso
 * @property Collection|IndicadoresSgsi[] $indicadores_sgsis
 */
class Proceso extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
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
        $riesgo = intval($this->proceso_octave_riesgo);

        switch (true) {
            case $riesgo <= 5:
                return '#0C7000';
            case $riesgo <= 20:
                return '#2BE015';
            case $riesgo <= 50:
                return '#FFFF00';
            case $riesgo <= 80:
                return '#FF7000';
            default:
                return '#FF0000';
        }
    }

    //Redis methods
    public static function getAll($columns = ['id', 'codigo', 'nombre', 'id_macroproceso', 'descripcion'])
    {
        return Cache::remember('Procesos:procesos_all', 3600 * 7, function () use ($columns) {
            return self::select($columns)->with('macroproceso')->get();
        });
    }

    public function getProcesoOctaveRiesgoAttribute()
    {
        return $this->procesoOctave ? $this->procesoOctave->nivel_riesgo : 0;
    }

    public function getNameAttribute()
    {
        return $this->codigo.' '.$this->nombre;
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
