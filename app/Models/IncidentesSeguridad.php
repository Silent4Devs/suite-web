<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class IncidentesSeguridad extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;
    const ARCHIVADO = '1';
    const NO_ARCHIVADO = '0';

    protected $table = 'incidentes_seguridad';

    protected $dates = [
        'fecha' => 'format:d-m-Y',
    ];

    protected $guarded = [
        'id',
    ];

    protected $appends = ['folio', 'archivo'];

    // public function getFechaAttribute()
    // {
    //     return $this->fecha ? Carbon::parse($this->fecha)->format('d-m-Y'):'';
    // }

    public function getFolioAttribute()
    {
        return  sprintf('INC-%04d', $this->id);
    }

    public function reporto()
    {
        return $this->belongsTo(Empleado::class, 'empleado_reporto_id', 'id');
    }

    public function asignado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_asignado_id', 'id');
    }

    public function evidencias_seguridad()
    {
        return $this->hasMany(EvidenciasSeguridad::class, 'id_seguridad');
    }

    public function getArchivoAttribute()
    {
        return $this->getMedia('archivo')->first();
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function actividades()
    {
        return $this->hasMany(ActividadIncidente::class, 'seguridad_id', 'id');
    }
}
