<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class AuditoriaInterna extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;

    public $table = 'auditoria_internas';

    protected $appends = [
        'logotipo',
    ];

    public static $searchable = [
        'alcance',
    ];

    protected $dates = [
        'fechaauditoria',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'alcance',
        'clausulas_id',
        'fechaauditoria',
        'auditorlider_id',
        'equipoauditoria_id',
        'hallazgos',
        'cheknoconformidadmenor',
        'totalnoconformidadmenor',
        'checknoconformidadmayor',
        'totalnoconformidadmayor',
        'checkobservacion',
        'totalobservacion',
        'checkmejora',
        'totalmejora',
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

    public function clausulas()
    {
        return $this->belongsTo(Controle::class, 'clausulas_id');
    }

    public function getFechaauditoriaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaauditoriaAttribute($value)
    {
        $this->attributes['fechaauditoria'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function auditorlider()
    {
        return $this->belongsTo(User::class, 'auditorlider_id');
    }

    public function equipoauditoria()
    {
        return $this->belongsTo(User::class, 'equipoauditoria_id');
    }

    public function getLogotipoAttribute()
    {
        $file = $this->getMedia('logotipo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
