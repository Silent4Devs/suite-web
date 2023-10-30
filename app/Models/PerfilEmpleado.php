<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerfilEmpleado extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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

    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado', 'perfil_empleado_id', 'id');
    }

    // public function puestos()
    // {
    //     return $this->hasMany('App\Models\Empleado', 'perfil_empleado_id', 'id');
    // }
}
