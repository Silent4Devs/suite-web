<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ExperienciaEmpleados extends Model
{
    use SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'experiencia_empleados';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'empleado_id' => 'int',
        'empresa' => 'string',
        'puesto' => 'string',
        'descripcion' => 'string',
    ];

    protected $fillable = [
        'empleado_id',
        'empresa',
        'puesto',
        'inicio_mes',
        'fin_mes',
        'descripcion',

    ];

    protected $appends = ['inicio_mes_ymd', 'fin_mes_ymd'];

    public function getInicioMesYmdAttribute()
    {
        if ($this->inicio_mes) {
            return Carbon::parse($this->inicio_mes)->format('Y-m-d');
        } else {
            return null;
        }
    }

    public function getFinMesYmdAttribute()
    {
        if ($this->inicio_mes) {
            return Carbon::parse($this->fin_mes)->format('Y-m-d');
        } else {
            return null;
        }
    }

    public function empleado_experiencia()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function getInicioMesAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getFinMesAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }
}
