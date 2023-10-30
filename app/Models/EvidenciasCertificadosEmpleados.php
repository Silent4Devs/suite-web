<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciasCertificadosEmpleados extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
