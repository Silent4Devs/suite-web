<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'empleados';
    //public $preventsLazyLoading = true;
    //protected $with = ['children:id,name,foto,puesto as title,area,supervisor_id']; //Se desborda la memoria al entrar en un bucle infinito se opto por utilizar eager loading
    protected $fillable = [
        'name',
        'foto',
        'area_id',
        'puesto',
        'antiguedad',
        'estatus',
        'email',
        'n_empleado',
        'telefono',
        'genero',
        'n_registro',
        'supervisor_id',
    ];


    public function recursos()
    {
        return $this->belongsToMany(Recurso::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'supervisor_id', 'id'); //Sin Eager Loading
    }

    public function children()
    {
        return $this->hasMany(Empleado::class, 'supervisor_id', 'id')->with('children', 'supervisor', 'area'); //Eager Loading utilizar solo para construir un arbol si no puede desbordar la pila
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    // public static function getAllEmpleados($empleado, $empleados = null)
    // {
    //     if ($empleados == null) {
    //         $empleados = collect();
    //     }
    //     $empleados = $empleados->merge($empleado->supervisor);
    //     foreach ($empleado->children as $child) {
    //         $empleados = self::getAllEmpleados($child, $empleados);
    //     }

    //     return $empleados;
    // }
}
