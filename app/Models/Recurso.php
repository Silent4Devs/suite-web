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

class Recurso extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;

    public $table = 'recursos';

    protected $appends = [
        'certificado',
    ];

    public static $searchable = [
        'cursoscapacitaciones',
    ];

    protected $dates = [
        'fecha_curso',
        'fecha_fin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cursoscapacitaciones',
        'fecha_curso',
        'fecha_fin',
        'duracion',
        'tipo',
        'instructor',
        'descripcion',
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

    public function getFechaCursoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
        //return Carbon::parse($value)->format('d/m/Y H:i'); // Se cambio formato corroborar que nada se rompe
    }

    public function setFechaCursoAttribute($value)
    {

        $this->attributes['fecha_curso'] = $value ? Carbon::createFromFormat('Y-m-d\TH:i', $value)->toDateTimeString() : null;
        //$this->attributes['fecha_curso'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        //$this->attributes['fecha_curso'] =  Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function participantes()
    {
        return $this->belongsToMany(User::class);
    }

    public function getCertificadoAttribute()
    {
        return $this->getMedia('certificado');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
