<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Mejoras extends Model
{
    use HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'mejoras';

    protected $guarded = [
        'id',
    ];

    protected $appends = ['folio', 'fecha_creacion', 'fecha_de_cierre', 'fecha_reporte'];

    public function getFolioAttribute()
    {
        return  sprintf('MJA-%04d', $this->id);
    }

    public function mejoro()
    {
        return $this->belongsTo(Empleado::class, 'empleado_mejoro_id', 'id');
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function actividades()
    {
        return $this->hasMany(ActividadMejora::class, 'mejora_id', 'id');
    }

    public function getFechaCreacionAttribute()
    {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }

    public function getFechaDeCierreAttribute()
    {
        return $this->fecha_cierre ? Carbon::parse($this->fecha_ciere)->format('d-m-Y') : '';
    }

    public function getFechaReporteAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
