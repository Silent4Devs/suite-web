<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class TratamientoRiesgo extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

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
        return $this->belongsTo(Controle::class, 'control_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function getFechacompromisoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechacompromisoAttribute($value)
    {
        $this->attributes['fechacompromiso'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_reviso', 'id')->with('area');
    }
}
