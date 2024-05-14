<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Archivo extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, InteractsWithMedia, MultiTenantModelTrait, SoftDeletes;

    public $table = 'archivos';

    protected $appends = [
        'nombre',
    ];

    public static $searchable = [
        'nombre',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'carpeta_id',
        'created_at',
        'estado_id',
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

    public function carpeta()
    {
        return $this->belongsTo(Carpetum::class, 'carpeta_id');
    }

    public function getNombreAttribute()
    {
        return $this->getMedia('nombre')->last();
    }

    public function estado()
    {
        return $this->belongsTo(EstadoDocumento::class, 'estado_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
