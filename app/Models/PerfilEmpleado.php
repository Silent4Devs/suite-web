<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class PerfilEmpleado extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $table = 'perfil_empleados';
    // protected $guarded = ['id'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'nombre',
        'descripcion',
        'created_at',
        'updated_at',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('PerfilEmpleado:perfiles_empleados_all', 3600 * 4, function () {
            return self::get();
        });
    }

    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado', 'perfil_empleado_id', 'id');
    }

    // public function puestos()
    // {
    //     return $this->hasMany('App\Models\Empleado', 'perfil_empleado_id', 'id');
    // }
}
