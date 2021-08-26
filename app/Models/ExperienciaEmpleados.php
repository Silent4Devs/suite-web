<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExperienciaEmpleados extends Model
{
    use SoftDeletes;
	protected $table = 'experiencia_empleados';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $casts = [
        'empleado_id' => 'int',
        'nombre' => 'string',
        'puesto' => 'string',
        'descripcion' => 'longText',
	];

    protected $fillable = [
		'empleado_id',
        'nombre',
        'puesto',
        'descripcion',

	];

    public function empleado_experiencia(){

        return $this->belongsTo(Empleado::class,'empleado_id');

    }
}
