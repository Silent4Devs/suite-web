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

class MaterialIsoVeinticiente extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, InteractsWithMedia, MultiTenantModelTrait, SoftDeletes;

    public static $searchable = [
        'objetivo',
    ];

    public $table = 'material_iso_veinticientes';

    protected $appends = [
        'listaasistencia',
        'materialarchivo',
    ];

    const TIPOIMPARTICION_SELECT = [
        'presencial' => 'Presencial',
        'virtual' => 'Virtual',
    ];

    protected $dates = [
        'fechacreacion_actualizacion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'objetivo',
        'arearesponsable_id',
        'tipoimparticion',
        'fechacreacion_actualizacion',
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

    public function getListaasistenciaAttribute()
    {
        return $this->getMedia('listaasistencia')->last();
    }

    public function arearesponsable()
    {
        return $this->belongsTo(Area::class, 'arearesponsable_id');
    }

    public function getFechacreacionActualizacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechacreacionActualizacionAttribute($value)
    {
        $this->attributes['fechacreacion_actualizacion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getMaterialarchivoAttribute()
    {
        return $this->getMedia('materialarchivo')->last();
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
