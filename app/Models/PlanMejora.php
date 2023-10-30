<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanMejora extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'plan_mejoras';

    public static $searchable = [
        'descripcion',
    ];

    protected $dates = [
        'fecha_compromiso',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ESTATUS_SELECT = [
        'por_iniciar' => 'Por iniciar',
        'en_proceso' => 'En proceso',
        'terminado' => 'Terminado',
    ];

    protected $fillable = [
        'mejora_id',
        'descripcion',
        'responsable_id',
        'fecha_compromiso',
        'estatus',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function mejora()
    {
        return $this->belongsTo(Registromejora::class, 'mejora_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function getFechaCompromisoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaCompromisoAttribute($value)
    {
        $this->attributes['fecha_compromiso'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
