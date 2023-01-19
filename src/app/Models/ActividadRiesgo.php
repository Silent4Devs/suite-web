<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ActividadRiesgo extends Model
{
    use HasFactory, SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'actividades_riesgos';

    protected $guarded = ['id'];

    public function riesgos_identificados()
    {
        return $this->belongsTo(RiesgoIdentificado::class, 'riesgo_id', 'id');
    }

    public function responsables()
    {
        return $this->belongsToMany(Empleado::class, 'actividades_riesgos_responsables', 'actividad_id', 'responsable_id')->alta();
    }
}
