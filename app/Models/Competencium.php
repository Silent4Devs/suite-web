<?php

namespace App\Models;

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

class Competencium extends Model implements HasMedia, Auditable
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'competencia';

    protected $appends = [
        'certificados',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombrecolaborador_id',
        'perfilpuesto',
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

    public function nombrecolaborador()
    {
        return $this->belongsTo(User::class, 'nombrecolaborador_id');
    }

    public function getCertificadosAttribute()
    {
        return $this->getMedia('certificados');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    // public function empleado()
    // {
    //     return $this->belongsTo(Empleado::class, 'id_empleado', 'id')->with('area');
    // }
}
