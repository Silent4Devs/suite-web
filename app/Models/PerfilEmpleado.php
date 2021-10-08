<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilEmpleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'perfil_empleados';
    protected $guarded = ['id'];

    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado', 'perfil_empleado_id', 'id');
    }
}
