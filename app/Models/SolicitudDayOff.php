<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\Cache;

class SolicitudDayOff extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'solicitud_dayoff';

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
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->select('name', 'id');
    }

    public static function getAllwithEmpleados()
    {
        return Cache::remember('SolicitudDayOff:solicitud_day_off_all', 3600 * 12, function () {
            return self::with('empleado')->orderBy('id', 'desc')->get(); // Ordering by 'id' column in descending order
        });
    }
}
