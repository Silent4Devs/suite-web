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
