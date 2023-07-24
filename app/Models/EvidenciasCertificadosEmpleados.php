<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciasCertificadosEmpleados extends Model
{
    use SoftDeletes;
    protected $table = 'evidencias_certificados_empleados';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'empleado_id' => 'int',
        'evidencia' => 'string',

    ];

    protected $fillable = [
        'empleado_id',
        'evidencia',

    ];

    public function empleado_documentos_certificados()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->alta();
    }
}
