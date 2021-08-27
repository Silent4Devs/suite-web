<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducacionEmpleados extends Model
{
    use SoftDeletes;
	protected $table = 'educacion_empleados';

    const NivelSelect = [
        'Licenciatura' => 'Licenciatura',
        'Maestria'     => 'Maestria',
        'Doctorado'    => 'Doctorado',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $casts = [
        'empleado_id' => 'int',
        'institucion' => 'string',
        'carrera' => 'string',
	];

    protected $fillable = [
		'empleado_id',
        'institucion',
        'carrera',

	];

    public function empleado_educacion(){

        return $this->belongsTo(Empleado::class,'empleado_id');

    }
}
