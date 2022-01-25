<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class EducacionEmpleados extends Model
{
    use SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'educacion_empleados';

    const NivelSelect = [
        'Primaria' => 'Primaria',
        'Secundaria' => 'Secundaria',
        'Preparatoria' => 'Preparatoria',
        'Bachillerato' => 'Bachillerato',
        'Técnico' => 'Técnico',
        'Ingeniería' => 'Ingeniería',
        'Licenciatura' => 'Licenciatura',
        'Maestria'     => 'Maestria',
        'Doctorado'    => 'Doctorado',
    ];

    protected $dates = [
        'año_inicio',
        'año_fin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'empleado_id' => 'int',
        'institucion' => 'string',
        'nivel' => 'string',
        'estudactualmente' => 'boolean',

    ];

    protected $fillable = [
        'empleado_id',
        'institucion',
        'nivel',
        'año_inicio',
        'año_fin',
        'titulo_obtenido',
        'estudactualmente',
    ];

    protected $appends = ['year_inicio_ymd', 'year_fin_ymd'];

    public function getYearInicioYmdAttribute()
    {
        if ($this->año_inicio) {
            return Carbon::parse($this->año_inicio)->format('Y-m-d');
        } else {
            return null;
        }
    }

    public function getYearFinYmdAttribute()
    {
        if ($this->año_fin) {
            return Carbon::parse($this->año_fin)->format('Y-m-d');
        } else {
            return null;
        }
    }

    public function empleado_educacion()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function getAñoInicioAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getAñoFinAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }
}
