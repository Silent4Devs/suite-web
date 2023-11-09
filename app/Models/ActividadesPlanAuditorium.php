<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ActividadesPlanAuditorium.
 *
 * @property int $id
 * @property string|null $actividad_auditar
 * @property Carbon|null $fecha_act_auditoria
 * @property time without time zone|null $hora_inicio
 * @property time without time zone|null $hora_fin
 * @property int|null $id_contacto
 * @property int|null $plan_auditoria_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Empleado|null $empleado
 * @property PlanAuditorium|null $plan_auditorium
 */
class ActividadesPlanAuditorium extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'actividades_plan_auditoria';

    protected $casts = [
        'hora_inicio' => 'time without time zone',
        'hora_fin' => 'time without time zone',
        'id_contacto' => 'int',
        'plan_auditoria_id' => 'int',
    ];

    protected $dates = [
        'fecha_act_auditoria',
    ];

    protected $fillable = [
        'actividad_auditar',
        'fecha_act_auditoria',
        'hora_inicio',
        'hora_fin',
        'id_contacto',
        'plan_auditoria_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_contacto')->alta();
    }

    public function plan_auditorium()
    {
        return $this->belongsTo(PlanAuditorium::class, 'plan_auditoria_id');
    }
}
