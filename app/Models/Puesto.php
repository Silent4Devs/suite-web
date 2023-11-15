<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class Puesto extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, MultiTenantModelTrait, SoftDeletes;

    public $table = 'puestos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'puesto',
        'descripcion',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'id_area',
        'id_reporta',
        'estudios',
        'experiencia',
        'conocimientos',
        'conocimientos_esp',
        'certificaciones',
        'sueldo',
        'lugar_trabajo',
        'horario_inicio',
        'horario_termino',
        'edad_de',
        'edad_a',
        'rango_edad',
        'horario_fin',
        'genero',
        'estado_civil',
        'fecha_puesto',
        'edad',
        'horario',
        'personas_internas',
        'personas_externas',
        'perfil_empleado_id',
        'entrenamiento',
        'elaboro_id',
        'reviso_id',
        'autoriza_id',
        'reporta_puesto_id',
    ];

    //Redis methods
    public static function getExists()
    {
        return Cache::remember('Puestos:Puestos_exists', 3600 * 12, function () {
            return DB::table('puestos')->exists();
        });
    }

    public static function getAll()
    {
        return Cache::remember('Puestos_all', 3600 * 8, function () {
            return self::get();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function competencias()
    {
        return $this->hasMany('App\Models\RH\CompetenciaPuesto', 'puesto_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'id_area', 'id');
    }

    // public function reportara()
    // {
    //     return $this->belongsTo(Empleado::class, 'id_reporta', 'id')->with('area');
    // }

    // public function reporto()
    // {
    //     return $this->belongsTo(Empleado::class, 'id_reporto', 'id')->with('area');
    // }

    public function empleados()
    {
        return $this->belongsTo(Empleado::class, 'elaboro_id', 'reviso_id', 'autoriza_id', 'id')->alta()->with('area');
    }

    public function elaboro()
    {
        return $this->belongsTo(Empleado::class, 'elaboro_id', 'id')->alta()->with('area');
    }

    public function reviso()
    {
        return $this->belongsTo(Empleado::class, 'reviso_id', 'id')->alta()->with('area');
    }

    public function autoriza()
    {
        return $this->belongsTo(Empleado::class, 'autoriza_id', 'id')->alta()->with('area');
    }

    public function language()
    {
        // return $this->belongsToMany(Language::class, 'puesto_idioma_porcentaje_pivot','id_puesto', 'id_language');
        return $this->hasMany('App\Models\PuestoIdiomaPorcentajePivot', 'id_puesto')->orderBy('id');
    }

    // public function perfil()
    // {
    //     return $this->belongsTo('App\Models\PerfilEmpleado', 'perfil_empleado_id', 'id');
    // }

    // public function idioma()
    // {
    //     // return $this->belongsToMany(Language::class, 'puesto_idioma_porcentaje_pivot','id_puesto', 'id_language');
    //     return $this->hasMany('App\Models\Language')->orderBy('id');
    // }

    public function reportara()
    {
        return $this->belongsTo('App\Models\Puesto', 'reporta_puesto_id', 'id');
    }

    public function competencia()
    {
        return $this->hasMany('App\Models\RH\Competencia', 'competencias_id', 'id');
    }

    public function responsabilidades()
    {
        return $this->hasMany('App\Models\PuestoResponsabilidade', 'puesto_id')->orderBy('id');
    }

    public function certificados()
    {
        return $this->hasMany('App\Models\PuestosCertificado', 'puesto_id')->orderBy('id');
    }

    public function herramientas()
    {
        return $this->hasMany('App\Models\HerramientasPuestos', 'puesto_id')->orderBy('id');
    }

    public function contactos()
    {
        return $this->hasMany('App\Models\PuestoContactos', 'puesto_id', 'id')->orderBy('id');
    }

    public function externos()
    {
        return $this->hasMany('App\Models\ContactosExternosPuestos', 'puesto_id', 'id')->orderBy('id');
    }
}
