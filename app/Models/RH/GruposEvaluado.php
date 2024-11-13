<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class GruposEvaluado extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'ev360_grupos_evaluados';

    protected $fillable = ['nombre'];

    public static function getAll()
    {
        return Cache::remember('GruposEvaluado:gruposevaluado_all', 3600 * 7, function () {
            return self::orderByDesc('id')->get();
        });
    }

    public static function getAllWithEmpleado()
    {
        return Cache::remember('GruposEvaluado:gruposevaluado_with_empleado', 3600 * 7, function () {
            return self::with('empleados')->get();
        });
    }

    public function empleados()
    {
        return $this->belongsToMany('App\Models\Empleado', 'ev360_empleados_grupos_evaluados', 'grupo_id', 'empleado_id');
    }

    public function empleadosEvaluacion()
    {
        return $this->belongsToMany('App\Models\Empleado', 'ev360_empleados_grupos_evaluados', 'grupo_id', 'empleado_id')->select('empleados.id', 'empleados.name');
    }
}
