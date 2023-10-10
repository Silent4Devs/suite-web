<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EducacionEmpleados extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'educacion_empleados';

    const NivelSelect = [
        'Primaria' => 'Primaria',
        'Secundaria' => 'Secundaria',
        'Preparatoria' => 'Preparatoria',
        'Bachillerato' => 'Bachillerato',
        'Técnico' => 'Técnico',
        'Ingeniería' => 'Ingeniería',
        'Licenciatura' => 'Licenciatura',
        'Maestria' => 'Maestria',
        'Doctorado' => 'Doctorado',
    ];

    protected $dates = [
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

    public function empleado_educacion()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->alta();
    }

    // public function getAñoInicioAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    // }

    // public function getAñoFinAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    // }
}
