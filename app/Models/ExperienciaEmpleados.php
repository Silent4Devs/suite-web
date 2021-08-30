<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function empleado_experiencia(){

        return $this->belongsTo(Empleado::class,'empleado_id');

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
