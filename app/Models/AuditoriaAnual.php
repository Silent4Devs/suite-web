<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class AuditoriaAnual extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'auditoria_anuals';

    public static $searchable = [
        'tipo',
    ];

    const TIPO_SELECT = [
        'Interna' => 'Interna',
        'Externa' => 'Externa',
    ];

    protected $dates = [
        'fechainicio',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tipo',
        'fechainicio',
        'dias',
        'auditorlider_id',
        'observaciones',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function fechaPlanAuditoria()
    {
        return $this->hasMany(PlanAuditorium::class, 'fecha_id', 'id');
    }

    public function getFechainicioAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechainicioAttribute($value)
    {
        $this->attributes['fechainicio'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function auditorlider()
    {
        return $this->belongsTo(User::class, 'auditorlider_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
