<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ActividadIncidente extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $table = 'actividades_incidentes';

    protected $guarded = ['id'];

    public function incidente_seguridad()
    {
        return $this->belongsTo(IncidentesSeguridad::class, 'seguridad_id', 'id');
    }

    public function responsables()
    {
        return $this->belongsToMany(Empleado::class, 'actividades_incidentes_responsables', 'actividad_id', 'responsable_id')->alta();
    }
}
