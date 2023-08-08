<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TratamientoRiesgo extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'tratamiento_riesgos';

    public static $searchable = [
        'nivelriesgo',
    ];

    protected $dates = [
        'fechacompromiso',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PRIORIDAD_SELECT = [
        'Critica' => 'Crítica',
        'Alta' => 'Alta',
        'Media' => 'Media',
        'Baja' => 'Baja',
    ];

    const TIPO_INVERSION_SELECT = [
        '1' => 'Sí',
        '0' => 'No',
    ];

    protected $fillable = [
        'identificador',
        'descripcionriesgo',
        'tipo_riesgo',
        'riesgototal',
        'riesgo_total_residual',
        'acciones',
        'id_proceso',
        'nivelriesgo',
        'control_id',
        'id_reviso',
        'acciones',
        'responsable_id',
        'fechacompromiso',
        'prioridad',
        'estatus',
        'probabilidad',
        'impacto',
        'nivelriesgoresidual',
        'id_dueno',
        'inversion_requerida',
        'matriz_sistema_gestion_id',
        'id_registro',
        'comentarios',
        'firma_responsable_aprobador',
        'es_aprobado',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function control()
    {
        return $this->belongsTo(DeclaracionAplicabilidad::class, 'control_id', 'id');
    }

    // public function responsable()
    // {
    //     return $this->belongsTo(User::class, 'responsable_id');
    // }

    public function getFechacompromisoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    // public function setFechaCompromisoAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    // }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'id_dueno', 'id')->alta()->with('area');
    }

    public function registro()
    {
        return $this->belongsTo(Empleado::class, 'id_registro', 'id')->alta()->with('area');
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    public function participantes()
    {
        return $this->belongsToMany(Empleado::class, 'empleados_tratamiento_riesgos', 'tratamiento_id', 'empleado_id')->alta()->with('area');
    }
}
