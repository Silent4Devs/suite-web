<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActividadRiesgo extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
