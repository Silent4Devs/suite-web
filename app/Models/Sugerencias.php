<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Sugerencias extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    const ARCHIVADO = '1';

    const NO_ARCHIVADO = '0';

    protected $table = 'sugerencias';

    protected $guarded = [
        'id',
    ];

    protected $appends = ['folio', 'fecha_de_cierre', 'fecha_reporte'];

    //Redis methods
    public static function getAll()
    {
        //retrieve all data or can pass columns to retrieve
        return Cache::remember('sugerencias_all', 3600, function () {
            return self::orderBy('id')->get();
        });
    }

    public function getFolioAttribute()
    {
        return sprintf('SUG-%04d', $this->id);
    }

    public function sugirio()
    {
        return $this->belongsTo(Empleado::class, 'empleado_sugirio_id', 'id')->alta();
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function actividades()
    {
        return $this->hasMany(ActividadSugerencia::class, 'sugerencia_id', 'id');
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
