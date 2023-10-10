<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PlanAuditoriaActividades extends Model implements Auditable
{
    use SoftDeletes, HasFactory;
    use \OwenIt\Auditing\Auditable;

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
