<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class CursosDiplomasEmpleados extends Model
{
    use SoftDeletes;
    use QueryCacheable;

    protected $table = 'cursos_diplomados_empleados';
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TipoSelect = [
        'Curso' => 'Curso',
        'Diplomado' => 'Diplomado',
    ];

    protected $casts = [
        'empleado_id' => 'int',
        'curso_diploma' => 'string',
        'tipo' => 'string',
        'año' => 'string',
        'duracion' => 'string',
    ];

    protected $fillable = [
        'empleado_id',
        'curso_diploma',
        'tipo',
        'año',
        'duracion',

    ];

    protected $appends = ['year_ymd'];

    public function getYearYmdAttribute()
    {
        if ($this->año) {
            return Carbon::parse($this->año)->format('Y-m-d');
        } else {
            return null;
        }
    }

    public function empleado_cursos()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function getAñoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }
}
