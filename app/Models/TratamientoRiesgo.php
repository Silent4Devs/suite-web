<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class TratamientoRiesgo extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
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
        'Alta'    => 'Alta',
        'Media'   => 'Media',
        'Baja'    => 'Baja',
    ];

    protected $fillable = [
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
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function control()
    {
        return $this->belongsTo(DeclaracionAplicabilidad::class, 'control_id', 'id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

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

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_reviso', 'id')->alta()->with('area');
    }
}
