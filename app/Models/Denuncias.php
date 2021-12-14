<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Denuncias extends Model
{
    use HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'denuncias';

    protected $guarded = [
        'id',
    ];

    protected $appends = ['folio','fecha_creacion','fecha_reporte','fecha_de_cierre'];

    public function getFolioAttribute()
    {
        return  sprintf('DEN-%04d', $this->id);
    }

    public function denuncio()
    {
        return $this->belongsTo(Empleado::class, 'empleado_denuncio_id', 'id');
    }

    public function evidencias_denuncias()
    {
        return $this->hasMany(EvidenciasDenuncia::class, 'id_denuncias');
    }

    public function denunciado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_denunciado_id', 'id');
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function actividades()
    {
        return $this->hasMany(ActividadDenuncia::class, 'denuncia_id', 'id');
    }

    public function getFechaCreacionAttribute()
    {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }

    public function getFechaDeCierreAttribute()
    {
        return $this->fecha_cierre ? Carbon::parse($this->fecha_ciere)->format('d-m-Y'):'';
    }

    public function getFechaReporteAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
