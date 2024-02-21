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

class InformacionDocumetada extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, InteractsWithMedia, MultiTenantModelTrait, SoftDeletes;

    protected $appends = [
        'logotipo',
    ];

    public $table = 'informacion_documetadas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TIPODOCUMENTO_SELECT = [
        'M' => 'Manual',
        'PL' => 'Plan',
        'P' => 'Proceso',
        'PR' => 'Procedimiento',
        'I' => 'Instructivo',
        'F' => 'Formato',
    ];

    protected $fillable = [
        'titulodocumento',
        'tipodocumento',
        'identificador',
        'version',
        'contenido',
        'elaboro_id',
        'reviso_id',
        'aprobacion_id',
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

    public function politicas()
    {
        return $this->belongsToMany(PoliticaSgsi::class);
    }

    public function elaboro()
    {
        return $this->belongsTo(User::class, 'elaboro_id');
    }

    public function reviso()
    {
        return $this->belongsTo(User::class, 'reviso_id');
    }

    public function aprobacion()
    {
        return $this->belongsTo(User::class, 'aprobacion_id');
    }

    public function getLogotipoAttribute()
    {
        $file = $this->getMedia('logotipo')->last();

        if ($file) {
            $file->url = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
        }

        return $file;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
