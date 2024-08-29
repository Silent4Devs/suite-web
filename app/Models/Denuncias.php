<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Denuncias extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'denuncias';

    protected $guarded = [
        'id',
    ];

    protected $appends = ['folio', 'fecha_creacion', 'fecha_reporte', 'fecha_de_cierre'];

    protected $fillable = [
        'anonimo',
        'estatus',
        'empleado_denuncio_id',
        'empleado_denunciado_id',
        'tipo',
        'fecha',
        'fecha_cierre',
        'sede',
        'ubicacion',
    ];

    //Redis methods
    public static function getAll()
    {
        //retrieve all data or can pass columns to retrieve resolve
        return Cache::remember('denuncias_all', 3600 * 4, function () {
            return self::get();
        });
    }

    public function getFolioAttribute()
    {
        return sprintf('DEN-%04d', $this->id);
    }

    public function denuncio()
    {
        return $this->belongsTo(Empleado::class, 'empleado_denuncio_id');
    }

    public function evidencias_denuncias()
    {
        return $this->hasMany(EvidenciasDenuncia::class, 'id_denuncias');
    }

    public function denunciado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_denunciado_id');
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
