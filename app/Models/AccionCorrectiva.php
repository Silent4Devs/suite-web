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

class AccionCorrectiva extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;

    public $table = 'accion_correctivas';

    protected $appends = [
        'documentometodo',
    ];

    public static $searchable = [
        'tema',
        'causaorigen',
    ];

    const ESTATUS_SELECT = [
        'por_iniciar' => 'Por iniciar',
        'en_proceso'  => 'En proceso',
        'terminado'   => 'Terminado',
    ];

    const METODO_CAUSA_SELECT = [
        'lluvia_ideas' => 'Lluvia de ideas',
        'cinco_porque' => 'Cinco porqués',
        'Ishikawa'     => 'Ishikawa',
    ];

    protected $dates = [
        'fecharegistro',
        'fecha_compromiso',
        'fecha_verificacion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const CAUSAORIGEN_SELECT = [
        'desviacion_proceso'    => 'Desviación en los procesos',
        'queja_cliente'         => 'Queja de un cliente',
        'auditoria_interna'     => 'Auditoría Interna',
        'desviacion_inicadores' => 'Desviación a los indicadores',
        'incumplimiento_ns'     => 'Incumplimiento a los niveles de servicio',
        'otro'                  => 'Otro',
    ];

    protected $fillable = [
        'fecharegistro',
        'nombrereporta_id',
        'puestoreporta_id',
        'nombreregistra_id',
        'puestoregistra_id',
        'tema',
        'causaorigen',
        'descripcion',
        'metodo_causa',
        'solucion',
        'cierre_accion',
        'estatus',
        'fecha_compromiso',
        'fecha_verificacion',
        'responsable_accion_id',
        'nombre_autoriza_id',
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

    public function accioncorrectivaPlanaccionCorrectivas()
    {
        return $this->hasMany(PlanaccionCorrectiva::class, 'accioncorrectiva_id', 'id');
    }

    public function getFecharegistroAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFecharegistroAttribute($value)
    {
        $this->attributes['fecharegistro'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function nombrereporta()
    {
        return $this->belongsTo(User::class, 'nombrereporta_id');
    }

    public function puestoreporta()
    {
        return $this->belongsTo(Puesto::class, 'puestoreporta_id');
    }

    public function nombreregistra()
    {
        return $this->belongsTo(User::class, 'nombreregistra_id');
    }

    public function puestoregistra()
    {
        return $this->belongsTo(Puesto::class, 'puestoregistra_id');
    }

    public function getFechaCompromisoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaCompromisoAttribute($value)
    {
        $this->attributes['fecha_compromiso'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFechaVerificacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaVerificacionAttribute($value)
    {
        $this->attributes['fecha_verificacion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function responsable_accion()
    {
        return $this->belongsTo(User::class, 'responsable_accion_id');
    }

    public function nombre_autoriza()
    {
        return $this->belongsTo(User::class, 'nombre_autoriza_id');
    }

    public function getDocumentometodoAttribute()
    {
        return $this->getMedia('documentometodo')->last();
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
