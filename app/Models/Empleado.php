<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Empleado
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $n_registro
 * @property string|null $foto
 * @property string|null $puesto
 * @property Carbon|null $antiguedad
 * @property string|null $estatus
 * @property string|null $email
 * @property string|null $telefono
 * @property string|null $genero
 * @property string|null $n_empleado
 * @property int|null $supervisor_id
 * @property int|null $area_id
 * @property int|null $sede_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Area|null $area
 * @property Sede|null $sede
 * @property Empleado|null $empleado
 * @property Collection|AnalisisDeRiesgo[] $analisis_de_riesgos
 * @property Collection|Documento[] $documentos
 * @property Collection|Recurso[] $recursos
 * @property Collection|Empleado[] $empleados
 * @property Collection|EntendimientoOrganizacion[] $entendimiento_organizacions
 * @property Collection|HistorialVersionesDocumento[] $historial_versiones_documentos
 * @property Collection|IndicadoresSgsi[] $indicadores_sgsis
 * @property Collection|MatrizRiesgo[] $matriz_riesgos
 * @property Collection|RevisionDocumento[] $revision_documentos
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Empleado extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'empleados';

    protected $casts = [
        'supervisor_id' => 'int',
        'area_id' => 'int',
        'sede_id' => 'int'
    ];

    public static $searchable = [
        'name'
    ];

    protected $dates = [
        'antiguedad'
    ];

    //public $preventsLazyLoading = true;
    //protected $with = ['children:id,name,foto,puesto as title,area,supervisor_id']; //Se desborda la memoria al entrar en un bucle infinito se opto por utilizar eager loading
    protected $appends = ['avatar'];

    protected $fillable = [
        'name',
        'n_registro',
        'foto',
        'puesto',
        'antiguedad',
        'estatus',
        'email',
        'telefono',
        'genero',
        'n_empleado',
        'supervisor_id',
        'area_id',
        'sede_id'
    ];

    public function getAvatarAttribute()
    {
        if ($this->foto == null) {
            if ($this->genero == 'H') {
                return "man.png";
            } elseif ($this->genero == 'M') {
                return "woman.png";
            } else {
                return "usuario_no_cargado";
            }
        }
        return $this->foto;
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id', 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'supervisor_id');
    }

    public function analisis_de_riesgos()
    {
        return $this->hasMany(AnalisisDeRiesgo::class, 'id_elaboro');
    }

    /*public function documentos()
    {
        return $this->hasMany(Documento::class, 'reviso_id');
    }*/

    public function recursos()
    {
        return $this->belongsToMany(Recurso::class)
            ->withPivot('id', 'calificacion', 'certificado')
            ->withTimestamps();
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'supervisor_id', 'id'); //Sin Eager Loading
    }

    public function entendimiento_organizacions()
    {
        return $this->hasMany(EntendimientoOrganizacion::class, 'id_elabora');
    }

    public function historial_versiones_documentos()
    {
        return $this->hasMany(HistorialVersionesDocumento::class, 'reviso_id');
    }

    public function indicadores_sgsis()
    {
        return $this->hasMany(IndicadoresSgsi::class, 'id_empleado');
    }

    public function matriz_riesgos()
    {
        return $this->hasMany(MatrizRiesgo::class, 'id_responsable');
    }

    public function revision_documentos()
    {
        return $this->hasMany(RevisionDocumento::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'n_empleado', 'n_empleado');
    }

    public function supervisor()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function children()
    {
        return $this->hasMany(Empleado::class, 'supervisor_id', 'id')->with('children', 'supervisor', 'area'); //Eager Loading utilizar solo para construir un arbol si no puede desbordar la pila
    }
    public function fodas()
    {
        return $this->hasMany(EntendimientoOrganizacion::class, 'id_elabora', 'id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
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

    public function archivos()
    {
        return $this->hasMany(Documento::class);
    }

    public function procesos()
    {
        return $this->hasMany(Proceso::class);
    }
}
