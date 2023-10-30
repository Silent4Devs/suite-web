<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MaterialIsoVeinticiente extends Model implements HasMedia, Auditable
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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

    public function registerMediaConversions(Media $media = null): void
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
