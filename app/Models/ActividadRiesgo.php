<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ActividadRiesgo extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

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
