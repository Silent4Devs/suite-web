<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CertificacionesEmpleados extends Model
{
    use SoftDeletes;
	protected $table = 'certificaciones_empleados';


    protected $dates = [
        'vigencia',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $casts = [
        'empleado_id' => 'int',
        'nombre' => 'string',
        'estatus' => 'string',
	];

    protected $fillable = [
		'empleado_id',
        'nombre',
        'estatus',
        'vigencia',

	];

    public function empleado_certificaciones(){

        return $this->belongsTo(Empleado::class,'empleado_id');


    }

    public function getVigenciaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }


}
