<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienciaEmpleados extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('experienciaempleados_all', 3600 * 24, function () {
            return self::get();
        });
    }

    public function empleado_experiencia()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->alta();
    }
}
