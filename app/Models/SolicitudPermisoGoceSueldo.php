<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\Cache;

class SolicitudPermisoGoceSueldo extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'solicitud_permiso_goce_sueldo';

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
        'permiso_id',
    ];

    public function permiso()
    {
        return $this->belongsTo(PermisosGoceSueldo::class, 'permiso_id');
    }

    // public function tipo()
    // {
    //     return $this->belongsTo(PermisosGoceSueldo::class,'tipo_permiso');
    // }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->select('id', 'name', 'foto', 'area_id', 'puesto_id');
    }

    public static function getAllwithEmpleados()
    {
        return Cache::remember('SolicitudPermisoGoceSueldo:solicitud_permiso_goce_sueldo_all', 3600 * 12, function () {
            return self::with('empleado')->orderBy('id', 'desc')->get();
        });
    }
}
