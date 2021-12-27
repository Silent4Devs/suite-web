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
        'horario',
        'edad',
        'genero',
        'estado_civil',




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

    public function language(){
        return $this->belongsToMany('\App\Language','puesto_idioma_porcentaje_pivot')
            ->withPivot('id_idioma');
    }
    public function porcentaje(){
        return $this->belongsToMany('\App\Porcentaje','puesto_idioma_porcentaje_pivot')
            ->withPivot('id_porcentaje');
    }
}
