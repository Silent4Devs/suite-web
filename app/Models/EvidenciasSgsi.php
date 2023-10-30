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

class EvidenciasSgsi extends Model implements HasMedia, Auditable
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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

    public function registerMediaConversions(Media $media = null): void
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
