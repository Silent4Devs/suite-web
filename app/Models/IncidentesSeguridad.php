<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $appends = ['folio', 'archivo', 'fecha_creacion', 'fecha_cerrado'];

    // public function getFechaAttribute()
    // {
    //     return $this->fecha ? Carbon::parse($this->fecha)->format('d-m-Y'):'';
    // }

    public function getFolioAttribute()
    {
        return sprintf('INC-%04d', $this->id);
    }

    public function reporto()
    {
        return $this->belongsTo(Empleado::class, 'empleado_reporto_id', 'id')->alta();
    }

    public function asignado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_asignado_id', 'id')->alta();
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

    public function getFechaCreacionAttribute()
    {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }

    public function getFechaCerradoAttribute()
    {
        return $this->fecha_cierre ? Carbon::parse($this->fecha_ciere)->format('d-m-Y') : '';
    }

    public function accionCorrectivaAprobacional()
    {
        return $this->morphToMany(AccionCorrectiva::class, 'acciones_correctivas_aprobacionables', null, null, 'acciones_correctivas_id');
    }

    public function categorias()
    {
        return $this->belongsTo(CategoriaIncidente::class, 'categoria_id', 'id')->alta();
    }

    public function subcategorias()
    {
        return $this->belongsTo(SubcategoriaIncidente::class, 'subcategoria_id', 'id')->alta();
    }
}
