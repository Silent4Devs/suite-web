<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class IncidentesDeSeguridad extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, MultiTenantModelTrait, SoftDeletes;

    public $table = 'incidentes_de_seguridads';

    public static $searchable = [
        'resumen',
    ];

    protected $dates = [
        'fechaocurrencia',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PRIORIDAD_SELECT = [
        '1' => 'Baja',
        '2' => 'Media',
        '3' => 'Alta',
        '4' => 'Crítica',
    ];

    protected $fillable = [
        'folio',
        'resumen',
        'estatus',
        'prioridad',
        'fechaocurrencia',
        'clasificacion',
        'created_at',
        'estado_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFechaocurrenciaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaocurrenciaAttribute($value)
    {
        $this->attributes['fechaocurrencia'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function activos()
    {
        return $this->belongsToMany(Activo::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoIncidente::class, 'estado_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
