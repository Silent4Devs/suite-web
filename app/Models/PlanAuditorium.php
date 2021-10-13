<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanAuditorium extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'plan_auditoria';

    public static $searchable = [
        'objetivo',
    ];

    protected $dates = [
        'fecha_auditoria',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'objetivo',
        'alcance',
        'criterios',
        'id_equipo_auditores',
        'documentoauditar',
        'fecha_auditoria',
        'descripcion',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // public function fecha()
    // {
    //     return $this->belongsTo(AuditoriaAnual::class, 'fecha_id');
    // }

    public function getFechaAuditoriaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }


    public function auditados()
    {
        return $this->belongsToMany(Empleado::class, 'plan_auditoria_empleados', 'plan_auditoria_id', 'empleado_id');
    }

    public function equipo()
    {
        return $this->belongsTo(Empleado::class, 'id_equipo_auditores', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
