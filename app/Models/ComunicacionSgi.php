<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ComunicacionSgi extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;

    public $table = 'comunicacion_sgis';

    // protected $appends = [
    //     'archivo',
    // ];

    const TipoSelect = [
        'Carrusel' => 'Carrusel',
        'Blog' => 'Blog',
        'Ambos' => 'Ambos',
    ];

    public static $searchable = [
        'descripcion',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [

        'descripcion',
        'id_publico',
        'fecha_publicacion',
        'titulo',
        'publicar_en',
        'habilitar',
        'link',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'fecha_programable',
        'fecha_programable_fin',
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

    public function getArchivoAttribute()
    {
        return $this->getMedia('archivo')->last();
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function documentos_comunicacion()
    {
        return $this->hasMany(DocumentoComunicacionSgis::class, 'comunicacion_id', 'id');
    }

    public function imagenes_comunicacion()
    {
        return $this->hasMany(ImagenesComunicacionSgis::class, 'comunicacion_id', 'id');
    }

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_comunicacion', 'comunicacion_id', 'empleado_id')->alta();
    }
}
