<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='empleados';
    protected $fillable = [
        'name',
        'foto',
        'area',
        'puesto',
        'jefe',
        'antiguedad',
        'estatus',
        'email',
        'n_empleado',
        'telefono',
        'n_registro',
    ];
}
