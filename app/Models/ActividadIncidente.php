<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActividadIncidente extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
