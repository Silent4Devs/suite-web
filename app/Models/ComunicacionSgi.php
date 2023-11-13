<?php

namespace App\Models;

use DateTimeInterface;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ComunicacionSgi extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, InteractsWithMedia, MultiTenantModelTrait, SoftDeletes;

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

    //Redis methods
    public static function getAllwithImagenes()
    {
        return Cache::remember('ComunicacionSGI:get_all_with_imagenes', 3600 * 10, function () {
            return self::with('imagenes_comunicacion')->get();
        });
    }

    public static function getAllwithImagenesBlog()
    {
        return Cache::remember('Portal:get_all_with_imagenes_blog', 3600 * 10, function () {
            return self::with('imagenes_comunicacion')->where('publicar_en', '=', 'Blog')->orWhere('publicar_en', '=', 'Ambos')->where('fecha_programable', '<=', Carbon::now()->format('Y-m-d'))->where('fecha_programable_fin', '>=', Carbon::now()->format('Y-m-d'))->get();
        });
    }

    public static function getAllwithImagenesCarrousel()
    {
        return Cache::remember('Portal:get_all_with_imagenes_carrousel', 3600 * 10, function () {
            return self::with('imagenes_comunicacion')->where('publicar_en', '=', 'Carrusel')->orWhere('publicar_en', '=', 'Ambos')->where('fecha_programable', '<=', Carbon::now()->format('Y-m-d'))->where('fecha_programable_fin', '>=', Carbon::now()->format('Y-m-d'))->get();
        });
    }

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
