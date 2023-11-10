<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Quejas extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'quejas';

    protected $guarded = [
        'id',
    ];

    protected $appends = ['folio', 'fecha_creacion', 'fecha_reporte', 'fecha_de_cierre'];

    //Redis methods
    public static function getAll()
    {
        //retrieve all data or can pass columns to retrieve
        return Cache::remember('quejas_all', 3600, function () {
            return self::get();
        });
    }

    public function getFolioAttribute()
    {
        return sprintf('QUE-%04d', $this->id);
    }

    public function quejo()
    {
        return $this->belongsTo(Empleado::class, 'empleado_quejo_id', 'id')->alta()->with('area');
    }

    public function evidencias_quejas()
    {
        return $this->hasMany(EvidenciasQueja::class, 'id_quejas');
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function actividades()
    {
        return $this->hasMany(ActividadQueja::class, 'queja_id', 'id');
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

    public function accionCorrectivaAprobacional()
    {
        return $this->morphToMany(AccionCorrectiva::class, 'acciones_correctivas_aprobacionables', null, null, 'acciones_correctivas_id');
    }
}
