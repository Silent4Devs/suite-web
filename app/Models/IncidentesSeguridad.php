<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class IncidentesSeguridad extends Model implements HasMedia
{
    use InteractsWithMedia;

    use HasFactory;
    use SoftDeletes;
    const ARCHIVADO = '1';
    const NO_ARCHIVADO = '0';

    protected $table='incidentes_seguridad';

    protected $dates=[
        'fecha'
    ];

    protected $guarded=[
        'id'
    ];

    protected $appends = ['folio', 'archivo'];

    public function getFolioAttribute(){
        return  sprintf('INC-%04d', $this->id);
    }

    public function reporto(){
        return $this->belongsTo(Empleado::class, 'empleado_reporto_id', 'id');
    }
    public function asignado(){
        return $this->belongsTo(Empleado::class, 'empleado_asignado_id', 'id');
    }

    public function evidencias(){
        return $this->morphMany(Evidencia::class, 'evidenciable');
    }

    public function getArchivoAttribute()
    {
        return $this->getMedia('archivo')->first();
    }
}
