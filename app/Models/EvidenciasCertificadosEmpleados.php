<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EvidenciasCertificadosEmpleados extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
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
