<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\Cache;

class IncidentesVacaciones extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'incidentes_vacaciones';

    public $fillable = [
        'nombre',
        'dias_aplicados',
        'aniversario',
        'efecto',
        'descripcion',
    ];

    public static function getAll()
    {
        return Cache::remember('IncidentesVacaciones:incidentes_vacaciones_all', 3600 * 12, function () {
            return self::orderBy('id', 'desc')->get(); // Ordering by 'id' column in descending order
        });
    }

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'incidentes_vacaciones_empleados', 'incidente_id', 'empleado_id');
    }
}
