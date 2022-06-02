<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class PlanificacionControl extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    public $table = 'planificacion_controls';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'descripcion',
        'vulnerabilidad',
        'amenaza',
    ];

    protected $fillable = [
        'activo',
        'descripcion',
        'dueno_id',
        'id_reviso',
        'vulnerabilidad',
        'amenaza',
        'confidencialidad',
        'integridad',
        'disponibilidad',
        'probabilidad',
        'impacto',
        'nivelriesgo',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function dueno()
    {
        return $this->belongsTo(User::class, 'dueno_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_reviso', 'id')->with('area')->alta();
    }
}
