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

class ControlAcceso extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, InteractsWithMedia, MultiTenantModelTrait, SoftDeletes;

    public $table = 'control_accesos';

    // protected $appends = [
    //     'archivo',
    // ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'descripcion',
        'controlA_id',
        'justificacion',
        'fecha_inicio',
        'fecha_fin',
        'responsable_id',
        'tipo_control_acceso_id',
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

    public function getArchivoAttribute()
    {
        return $this->getMedia('archivo')->last();
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function documentos_controlA()
    {
        return $this->hasMany(DocumentoControlAcceso::class, 'controlA_id', 'id');
    }

    public function tipo_de_permiso()
    {
        return $this->belongsTo(TipoDePermiso::class, 'tipo_control_acceso_id');
    }
}
