<?php

namespace App\Models;

use DateTimeInterface;
use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registromejora extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'registromejoras';

    public static $searchable = [
        'nombre',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PRIORIDAD_SELECT = [
        'alta' => 'Alta',
        'media' => 'Media',
        'Baja' => 'Baja',
    ];

    protected $fillable = [
        'nombre',
        'prioridad',
        'clasificacion',
        'descripcion',
        'recursos',
        'beneficios',
        'valida_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'id_reporta',
        'id_responsable',
        'id_participantes',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function mejoraDmaics()
    {
        return $this->hasMany(Dmaic::class, 'mejora_id', 'id');
    }

    public function mejoraPlanMejoras()
    {
        return $this->hasMany(PlanMejora::class, 'mejora_id', 'id');
    }

    public function nombre_reporta()
    {
        return $this->belongsTo(User::class, 'nombre_reporta_id');
    }

    public function responsableimplementacion()
    {
        return $this->belongsTo(User::class, 'responsableimplementacion_id');
    }

    public function valida()
    {
        return $this->belongsTo(User::class, 'valida_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_reporta')->alta();
    }
}
