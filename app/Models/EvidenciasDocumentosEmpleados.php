<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvidenciasDocumentosEmpleados extends Model
{
    use SoftDeletes;
	protected $table = 'evidencias_documentos_empleados';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $casts = [
        'empleado_id' => 'int',
        'documentos' => 'string',

	];

    protected $fillable = [
		'empleado_id',
        'documentos'

	];

    public function empleados_documentos(){

        return $this->belongsTo(Empleado::class,'empleado_id');

    }


}
