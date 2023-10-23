<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class AuditoriaAnual extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'auditoria_anuals';

    public static $searchable = [
        'tipo',
    ];

    protected $dates = [
        'fechainicio',
        'fechafin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'fechainicio',
        'fechafin',
        'fecha_auditoria',
        'objetivo',
        'alcance',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('auditoriaanual_all', 3600 * 12, function () {
            return self::get();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function fechaPlanAuditoria()
    {
        return $this->hasMany(PlanAuditorium::class, 'fecha_id', 'id');
    }

    // public function getFechainicioAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    // }

    // public function setFechainicioAttribute($value)
    // {
    //     $this->attributes['fechainicio'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public function auditorlider()
    {
        return $this->belongsTo(Empleado::class, 'auditorlider_id')->alta();
    }

    public function programa()
    {
        return $this->hasMany(AuditoriaAnualDocumento::class, 'id_auditoria_anuals', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function documentos_material()
    {
        return $this->hasMany(AuditoriaAnualDocumento::class, 'id_auditoria_anuals', 'id');
    }
}
