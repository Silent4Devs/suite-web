<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ExperienciaEmpleados extends Model
{
    use SoftDeletes;
    // use QueryCacheable;

    // public $cacheFor = 3600;
    // protected static $flushCacheOnUpdate = true;
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
        'trabactualmente' => 'boolean',
    ];

    protected $fillable = [
        'empleado_id',
        'empresa',
        'puesto',
        'inicio_mes',
        'fin_mes',
        'descripcion',
        'trabactualmente',

    ];

    public function empleado_experiencia()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->alta();
    }
}
