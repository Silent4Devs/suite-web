<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

/**
 * Class Area.
 *
 * @property int $id
 * @property string|null $area
 * @property int|null $id_grupo
 * @property int|null $id_reporta
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $team_id
 * @property Grupo|null $grupo
 * @property Team|null $team
 * @property Collection|Area[] $areas
 * @property Collection|ConcientizacionSgi[] $concientizacion_sgis
 * @property Collection|Empleado[] $empleados
 * @property Collection|MaterialIsoVeinticiente[] $material_iso_veinticientes
 * @property Collection|MaterialSgsi[] $material_sgsis
 * @property Collection|User[] $users
 */
class Area extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory, Filterable;

    protected $table = 'areas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id_grupo' => 'int',
        'id_reporta' => 'int',
        'team_id' => 'int',
    ];

    protected $fillable = [
        'area',
        'id_grupo',
        'id_reporta',
        'descripcion',
        'foto_area',
        'team_id',
        'empleados_id',
    ];

    protected $appends = ['grupo_name', 'foto_ruta'];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('areas_all', 3600 * 24, function () {
            return self::get();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function getGrupoNameAttribute()
    {
        return $this->grupo != null ? $this->grupo->nombre : 'Sin grupo seleccionado';
    }

    public function area()
    {
        return $this->belongsTo(self::class, 'id_reporta');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(self::class, 'id_reporta', 'id');
    }

    public function areas()
    {
        return $this->hasMany(self::class, 'id_reporta');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'id_reporta', 'id')->with('children', 'supervisor', 'grupo', 'lider'); //Eager Loading utilizar solo para construir un arbol si no puede desbordar la pila
    }

    public function concientizacion_sgis()
    {
        return $this->hasMany(ConcientizacionSgi::class, 'arearesponsable_id');
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class)->alta();
    }

    public function totalEmpleados()
    {
        return $this->hasMany(Empleado::class, 'area_id');
    }

    public function material_iso_veinticientes()
    {
        return $this->hasMany(MaterialIsoVeinticiente::class, 'arearesponsable_id');
    }

    public function material_sgsis()
    {
        return $this->hasMany(MaterialSgsi::class, 'arearesponsable_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function puesto()
    {
        return $this->hasMany(Puesto::class, 'id_area');
    }

    public function matriz_riesgos()
    {
        return $this->hasMany(MatrizRiesgo::class, 'id_responsable');
    }

    public function getFotoRutaAttribute()
    {
        $foto_url = asset('img/areas.jpg');
        if ($this->foto_area) {
            $foto_url = asset("storage/areas/{$this->foto_area}");
        }

        return $foto_url;
    }

    public function lider()
    {
        return $this->belongsTo(Empleado::class, 'empleados_id', 'id')->alta();
    }

    public function indicadores_sistema_gestion()
    {
        return $this->hasMany(IndicadoresSgsi::class, 'id_area');
    }
}
