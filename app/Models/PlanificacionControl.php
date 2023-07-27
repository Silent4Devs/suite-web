<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PlanificacionControl extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'planificacion_controls';

    protected $fillable = [
        'folio_cambio',
        'fecha_registro',
        'fecha_inicio',
        'fecha_termino',
        'objetivo',
        'criterios_aceptacion',
        'id_reviso',
        'id_responsable',
        'descripcion',
        'origen_id',
        'descripcion',
        'firma_registro',
        'firma_responsable',
        'firma_responsable_aprobador',
        'aprobado',
        'id_responsable_aprobar',
        'es_aprobado',
        'comentarios',

    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_reviso', 'id')->with('area')->alta();
    }

    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'id_responsable', 'id')->with('area')->alta();
    }

    public function responsableAprobar()
    {
        return $this->belongsTo(Empleado::class, 'id_responsable_aprobar', 'id')->with('area')->alta();
    }

    public function participantes()
    {
        return $this->belongsToMany(Empleado::class, 'empleados_planificacion_control', 'planificacion_id', 'empleado_id')->alta()->with('area');
    }

    public function origen()
    {
        return $this->belongsTo(PlanificacionControlOrigenCambio::class, 'origen_id');
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }
}
