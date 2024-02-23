<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PlanBaseActividade extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, InteractsWithMedia, MultiTenantModelTrait, SoftDeletes;

    protected $appends = [
        'guia',
    ];

    public $table = 'plan_base_actividades';

    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
        'compromiso',
        'real',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'actividad',
        'actividad_fase_id',
        'ejecutar_id',
        'estatus_id',
        'responsable_id',
        'colaborador_id',
        'fecha_inicio',
        'fecha_fin',
        'compromiso',
        'real',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('PlanBaseActividades:PlanBaseActividades_all', 3600 * 4, function () {
            return self::get();
        });
    }

    public static function getSelectId()
    {
        return Cache::remember('PlanBaseActividades:PlanBaseActividades_select_id', 3600 * 4, function () {
            return self::select('id')->get();
        });
    }

    public static function getWithActividad()
    {
        return Cache::remember('PlanBaseActividades:PlanBaseActividades_with_actividad', 3600 * 4, function () {
            return self::with('actividad_fase')->get();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    // public function actividad_padre()
    // {
    //     return $this->belongsTo(PlanBaseActividade::class, 'actividad_padre_id');
    // }

    public function ejecutar()
    {
        return $this->belongsTo(EnlacesEjecutar::class, 'ejecutar_id');
    }

    public function getGuiaAttribute()
    {
        return $this->getMedia('guia')->last();
    }

    public function estatus()
    {
        return $this->belongsTo(EstatusPlanTrabajo::class, 'estatus_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function colaborador()
    {
        return $this->belongsTo(User::class, 'colaborador_id');
    }

    public function getFechaInicioAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaInicioAttribute($value)
    {
        $this->attributes['fecha_inicio'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFechaFinAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaFinAttribute($value)
    {
        $this->attributes['fecha_fin'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCompromisoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCompromisoAttribute($value)
    {
        $this->attributes['compromiso'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getRealAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setRealAttribute($value)
    {
        $this->attributes['real'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
        //return $this->belongsTo('User');
    }

    public function actividad_fase()
    {
        return $this->belongsTo(ActividadFase::class);
    }
}
