<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\Cache;

class IncidentesDayoff extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'incidentes_dayoff';

    public $fillable = [
        'nombre',
        'dias_aplicados',
        'aniversario',
        'efecto',
        'descripcion',
    ];

    public static function getAll()
    {
        return Cache::remember('IncidentesDayoff:incidentes_dayoff_all', 3600 * 12, function () {
            return self::orderBy('id', 'desc')->get(); // Ordering by 'id' column in descending order
        });
    }

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'incidentes_dayoff_empleados', 'incidente_id', 'empleado_id');
    }

    public function puestos()
    {
        return $this->belongsToMany(Puesto::class, 'incidentes_dayoff_puestos', 'incidente_id', 'puesto_id');
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'incidentes_dayoff_areas', 'incidente_id', 'area_id');
    }
}
