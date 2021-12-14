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
    ];

    protected $fillable = [
        'empleado_id',
        'institucion',
        'nivel',
        'año_inicio',
        'año_fin',

    ];

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
