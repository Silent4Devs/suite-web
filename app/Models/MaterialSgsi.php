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

class MaterialSgsi extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, InteractsWithMedia, MultiTenantModelTrait, SoftDeletes;

    public $table = 'material_sgsis';

    // protected $appends = [
    //     'archivo',
    // ];

    public static $searchable = [
        'objetivo',
    ];

    const TIPOIMPARTICION_SELECT = [
        'presencial' => 'Presencial',
        'virtual' => 'Virtual',
    ];

    protected $dates = [
        'fechacreacion_actualizacion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'objetivo',
        'nombre',
        'material_id',
        'personalobjetivo',
        'arearesponsable_id',
        'tipoimparticion',
        'fechacreacion_actualizacion',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    const PERSONALOBJETIVO_SELECT = [
        'toda_organizacion' => 'Toda la organización',
        'proveedores' => 'Proveedores',
        'clientes' => 'Clientes',
        'toda_partes_interesadas' => 'Todas las partes interesadas',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function arearesponsable()
    {
        return $this->belongsTo(Area::class, 'arearesponsable_id');
    }

    public function getArchivoAttribute()
    {
        return $this->getMedia('archivo')->last();
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function documentos_material()
    {
        return $this->hasMany(DocumentoMaterialSgsi::class, 'material_id', 'id');
    }

    public function getFechacreacionactualizacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }
}
