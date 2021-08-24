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

class Minutasaltadireccion extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;

    protected $appends = [
        'archivo',
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
        'arearesponsable',
        'fechareunion',
        'hora_inicio',
        'hora_termino',
        'tema_reunion',
        'tema_tratado',
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'responsablereunion_id','id');
    }

    // public function getFechareunionAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    // }

    // public function setFechareunionAttribute($value)
    // {
    //     $this->attributes['fechareunion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

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
        return $this->belongsToMany(Empleado::class, 'empleados_minutas_alta_direccion', 'minuta_id','empleado_id');
    }


}
