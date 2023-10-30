<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PanelInicioRule extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;
    protected $table = 'panel_inicio_rules';

    public static function getAll()
    {
        return Cache::remember('PanelInicioRule:panel_inicio_all', 3600 * 2, function () {
            return DB::table('panel_inicio_rules')->select('nombre', 'n_empleado', 'area', 'jefe_inmediato', 'puesto', 'perfil', 'fecha_ingreso', 'genero', 'estatus', 'email', 'telefono', 'sede', 'direccion', 'cumpleaños')->get()->first();
        });
    }
}
