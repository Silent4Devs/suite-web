<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class EntendimientoOrganizacion extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'entendimiento_organizacions';

    protected $fillable = [
        'fortalezas',
        'oportunidades',
        'debilidades',
        'amenazas',
        'analisis',
        'fecha',
        'id_elabora',
        'estatus',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Redis methods
    public static function getAllWithEmpleadoParticipantes()
    {
        return Cache::remember('EntendimientoOrganizacion:entendimientoorganizacion_with_empleado_participantes', 3600 * 7, function () {
            return self::orderByDesc('id')->get();
        });
    }

    public static function getFirst()
    {
        return Cache::remember('EntendimientoOrganizacion:entendimientoorganizacion_first', 3600 * 7, function () {
            return self::first();
        });
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_elabora', 'id')->alta();
    }

    public function empleadoindiscriminado()
    {
        return $this->belongsTo(Empleado::class, 'id_elabora', 'id');
    }

    public function fodafortalezas()
    {
        return $this->hasMany(FortalezasEntendimientoOrganizacion::class, 'foda_id', 'id');
    }

    public function fodaoportunidades()
    {
        return $this->hasMany(OportunidadesEntendimientoOrganizacion::class, 'foda_id', 'id');
    }

    public function fodadebilidades()
    {
        return $this->hasMany(DebilidadesEntendimientoOrganizacion::class, 'foda_id', 'id');
    }

    public function fodamenazas()
    {
        return $this->hasMany(AmenazasEntendimientoOrganizacion::class, 'foda_id', 'id');
    }

    public function participantes()
    {
        return $this->belongsToMany(Empleado::class, 'participantes_entendimiento_organizacion', 'foda_id', 'empleado_id')->alta()->with('area');
    }
}
