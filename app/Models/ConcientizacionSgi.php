<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use OwenIt\Auditing\Contracts\Auditable;

class ConcientizacionSgi extends Model implements HasMedia, Auditable
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'concientizacion_sgis';

    // protected $appends = [
    //     'archivo',
    // ];

    public static $searchable = [
        'objetivocomunicado',
    ];

    protected $dates = [
        'fecha_publicacion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const MEDIO_ENVIO_SELECT = [
        'Correo' => 'Correo',
        'Poster' => 'Poster',
        'Revista' => 'Revista',
        'Folleto' => 'Folleto',
    ];

    protected $fillable = [
        'objetivocomunicado',
        'personalobjetivo',
        'arearesponsable_id',
        'medio_envio',
        'fecha_publicacion',
        'concientSgsi_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    const PERSONALOBJETIVO_SELECT = [
        'toda_organizacion' => 'Toda la organización',
        'proveedores' => 'Proveedores',
        'clientes' => 'Clientes',
        'toda_parte_interesada' => 'Todas las partes interesadas',
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

    public function arearesponsable()
    {
        return $this->belongsTo(Area::class, 'arearesponsable_id');
    }

    // public function getFechaPublicacionAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    // }

    // public function setFechaPublicacionAttribute($value)
    // {
    //     $this->attributes['fecha_publicacion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public function getFechaPublicacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getArchivoAttribute()
    {
        return $this->getMedia('archivo')->last();
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function documentos_concientizacion()
    {
        return $this->hasMany(DocumentoConcientizacionSgis::class, 'concientSgsi_id', 'id');
    }
}
