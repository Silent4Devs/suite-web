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
    protected $appends = ['avatar'];
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
        'sede_id',
    ];
    public function getAvatarAttribute()
    {
        if ($this->foto==null) {
            if($this->genero=='H'){
                return "man.png";
            }
            elseif ($this->genero=='M') {
               return "woman.png";
            }
            else{
                return "usuario_no_cargado";
            }
        }
        return $this->foto;
    }

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
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id', 'id');
    }
    public function fodas()
    {
		return $this->hasMany(EntendimientoOrganizacion::class,'id_elabora','id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function archivos()
    {
        return $this->hasMany(Documento::class);
    }

    public function procesos()
    {
        return $this->hasMany(Proceso::class);
    }


}
