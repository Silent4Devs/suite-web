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

class EvidenciasSgsi extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, InteractsWithMedia, MultiTenantModelTrait, SoftDeletes;

    public $table = 'evidencias_sgsis';

    // protected $appends = [
    //     'archivopdf',
    // ];

    protected $dates = [
        'fechadocumento',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'responsable_evidencia_id',
        'nombredocumento',
        'objetivodocumento',
        'responsable_id',
        'arearesponsable',
        'area_id',
        'fechadocumento',
        'evidencia',
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
        return $this->belongsTo(User::class, 'responsable_id');
    }

    // public function getFechadocumentoAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    // }

    // public function setFechadocumentoAttribute($value)
    // {
    //     $this->attributes['fechadocumento'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public function getArchivopdfAttribute()
    {
        return $this->getMedia('archivopdf')->last();
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function getFechaDocumentoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'responsable_evidencia_id')->alta();
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function evidencia_sgsi()
    {
        return $this->hasMany(EvidenciaSgsiPdf::class, 'id_evidencias_sgsis');
    }
}
