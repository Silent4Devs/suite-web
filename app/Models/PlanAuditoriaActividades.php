<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanAuditoriaActividades extends Model implements Auditable
{
    use SoftDeletes, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'plan_auditoria_actividades_anuals';

    protected $fillable = [
        'actividad_auditar',
        'fecha_auditoria',
        'horario_inicio',
        'horario_termino',
        'nombre_auditor',
        'id_auditado',
        'plan_auditoria_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function auditado()
    {
        return $this->belongsTo(Empleado::class, 'id_auditado', 'id')->alta()->with('area');
    }

    public function planAuditoria()
    {
        return $this->belongsTo(PlanAuditorium::class, 'plan_auditoria_id', 'id');
    }
}
