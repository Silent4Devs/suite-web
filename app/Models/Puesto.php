<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Puesto extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
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

    ];

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
        return $this->belongsTo(Area::class, 'id_area');
    }

    public function empleados()
    {
        return $this->belongsTo(Empleado::class, 'id_reporta');
    }

    public function language()
    {
        // return $this->belongsToMany(Language::class, 'puesto_idioma_porcentaje_pivot','id_puesto', 'id_language');
        return $this->hasMany('App\Models\PuestoIdiomaPorcentajePivot', 'id_puesto')->orderBy('id');

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
}
