<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class SolicitudVacaciones extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'solicitud_vacaciones';

    public $fillable = [
        'dias_solicitados',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'aprobacion',
        'empleado_id',
        'año',
        'autoriza',
        'comentarios_aprobador',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->select('name', 'id', 'foto', 'area_id', 'puesto_id');
    }

    public static function getAllwithEmpleados()
    {
        return Cache::remember('SolicitudVacaciones:solicitud_vacaciones_all', 3600 * 12, function () {
            return self::with('empleado')->orderByDesc('id')->get(); // Ordering by 'id' column in descending order
        });
    }
}
