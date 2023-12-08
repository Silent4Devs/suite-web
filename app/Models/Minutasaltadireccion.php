<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Minutasaltadireccion extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, InteractsWithMedia, MultiTenantModelTrait, SoftDeletes;

    // ESTATUS MINUTAS
    const EN_ELABORACION = 1;

    const EN_REVISION = 2;

    const PUBLICADO = 3;

    const DOCUMENTO_RECHAZADO = 4;

    const DOCUMENTO_OBSOLETO = 5;

    protected $appends = [
        'archivo', 'estatus_formateado', 'color_estatus',
    ];

    public $table = 'minutasaltadireccions';

    public static $searchable = [
        'objetivoreunion',
    ];

    protected $dates = [
        'fechareunion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'objetivoreunion',
        'responsablereunion_id',
        'responsable_id',
        'arearesponsable',
        'fechareunion',
        'hora_inicio',
        'hora_termino',
        'tema_reunion',
        'tema_tratado',
        'estatus',
        'documento',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'responsable_id', 'id')->alta();
    }

    // public function getFechareunionAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    // }

    // public function setFechareunionAttribute($value)
    // {
    //     $this->attributes['fechareunion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public function getEstatusFormateadoAttribute()
    {
        switch ($this->estatus) {
            case strval($this::EN_ELABORACION):
                return 'En Elaboración';
                break;
            case strval($this::EN_REVISION):
                return 'En Revisión';
                break;
            case strval($this::PUBLICADO):
                return 'Publicado';
                break;
            case strval($this::DOCUMENTO_RECHAZADO):
                return 'Documento Rechazado';
                break;
            default:
                return 'En Elaboración';
                break;
        }
    }

    public function getColorEstatusAttribute()
    {
        switch ($this->estatus) {
            case strval($this::EN_ELABORACION):
                return '#10A5C6';
                break;
            case strval($this::EN_REVISION):
                return '#1068C6';
                break;
            case strval($this::PUBLICADO):
                return '#10C639';
                break;
            case strval($this::DOCUMENTO_RECHAZADO):
                return '#E10D0D';
                break;
            default:
                return '#10A5C6';
                break;
        }
    }

    public function getArchivoAttribute()
    {
        return $this->getMedia('archivo')->last();
    }

    public function getFechareunionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function participantes()
    {
        return $this->belongsToMany(Empleado::class, 'empleados_minutas_alta_direccion', 'minuta_id', 'empleado_id')->alta()->with('area');
    }

    public function documentos()
    {
        return $this->hasMany(FilesRevisonDireccion::class, 'revision_id', 'id');
    }

    public function externos()
    {
        return $this->hasMany(ExternosMinutaDireccion::class, 'minuta_id', 'id');
    }

    // public function documentoss()
    // {
    //     return $this->belongsToMany(FilesRevisonDireccion::class, 'activos_contenedores', 'activo_id', 'contenedor_id');
    // }
}
