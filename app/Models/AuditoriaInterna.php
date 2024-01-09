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

class AuditoriaInterna extends Model implements Auditable, HasMedia
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, InteractsWithMedia, MultiTenantModelTrait, SoftDeletes;

    public $table = 'auditoria_internas';

    protected $appends = [
        'logotipo',
    ];

    const CLAUSULA_SELECT = [
        '4.1 Comprensión de la organización y de su contexto' => '4.1 Comprensión de la organización y de su contexto',
        '4.2 Comprensión de las necesidades y expectativas de las partes interesadas' => '4.2 Comprensión de las necesidades y expectativas de las partes interesadas',
        '4.3 Determinación del alcance del SGSI' => '4.3 Determinación del alcance del SGSI',
        '4.4 Sistema de Gestión de Seguridad de la Información' => '4.4 Sistema de Gestión de Seguridad de la Información',
        '5.1 Liderazgo y compromiso' => '5.1 Liderazgo y compromiso',
        '5.2 Política' => '5.2 Política',
        '5.3 Roles, responsabilidades y autoridades en la organización' => '5.3 Roles, responsabilidades y autoridades en la organización',
        '6.1 Acciones para tratar los riesgos y oportunidades' => '6.1 Acciones para tratar los riesgos y oportunidades',
        '6.1.1 Consideraciones generales' => '6.1.1 Consideraciones generales',
        '6.1.2 Apreciación de riesgos de seguridad de la información' => '6.1.2 Apreciación de riesgos de seguridad de la información',
        '6.1.3 Tratamiento de los riesgos de seguridad de la información' => '6.1.3 Tratamiento de los riesgos de seguridad de la información',
        '6.2 Objetivos de seguridad de la información y planificación para su consecusión' => '6.2 Objetivos de seguridad de la información y planificación para su consecusión',
        '7.1 Recursos' => '7.1 Recursos',
        '7.2 Competencia' => '7.2 Competencia',
        '7.3 Concienciación' => '7.3 Concienciación',
        '7.4 Comunicación' => '7.4 Comunicación',
        '7.5 Información documentada' => '7.5 Información documentada',
        '7.5.1 Consideraciones generales' => '7.5.1 Consideraciones generales',
        '7.5.2 Creación y actualización' => '7.5.2 Creación y actualización',
        '7.5.3 Control de la información documentada' => '7.5.3 Control de la información documentada',
        '8.1 Planificación y control operacional' => '8.1 Planificación y control operacional',
        '8.2 Apreciación de los riesgos de seguridad de la información' => '8.2 Apreciación de los riesgos de seguridad de la información',
        '8.3 Tratamiento de los riesgos de seguridad de la información' => '8.3 Tratamiento de los riesgos de seguridad de la información',
        '9.1 Seguimiento, medición, análisis y evaluación' => '9.1 Seguimiento, medición, análisis y evaluación',
        '9.2 Auditoría interna' => '9.2 Auditoría interna',
        '9.3 Revisión por la Dirección' => '9.3 Revisión por la Dirección',
        '10.1 No conformidad y acciones correctivas' => '10.1 No conformidad y acciones correctivas',
        '10.2 Mejora continua' => '10.2 Mejora continua',
    ];

    public static $searchable = [
        'alcance',
    ];

    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'alcance',
        'auditor_externo',
        'objetivo',
        'fecha_inicio',
        'hallazgos',
        'criterios_auditoria',
        'id_auditoria',
        'nombre_auditoria',
        'cheknoconformidadmenor',
        'totalnoconformidadmenor',
        'checknoconformidadmayor',
        'totalnoconformidadmayor',
        'checkobservacion',
        'totalobservacion',
        'checkmejora',
        'totalmejora',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'lider_id',
        'creador_auditoria_id', //Creador de la auditoria
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

    // public function clausulas()
    // {
    //     return $this->belongsTo(Controle::class, 'clausulas_id');
    // }

    public function getFechaauditoriaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaauditoriaAttribute($value)
    {
        $this->attributes['fechaauditoria'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function creadorAuditoria()
    {
        return $this->belongsTo(Empleado::class, 'creador_auditoria_id', 'id');
        // return $this->belongsTo(Empleado::class, 'creador_auditoria_id', 'id')->alta();
    }

    public function equipoauditoria()
    {
        return $this->belongsTo(User::class, 'equipoauditoria_id');
    }

    public function getLogotipoAttribute()
    {
        $file = $this->getMedia('logotipo')->last();

        if ($file) {
            $file->url = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
        }

        return $file;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function lider()
    {
        return $this->belongsTo(Empleado::class, 'lider_id', 'id')->alta();
    }

    public function equipo()
    {
        return $this->belongsToMany(Empleado::class, 'auditoria_interno_empleado', 'auditoria_id', 'empleado_id')->alta();
    }

    public function clausulas()
    {
        return $this->belongsToMany(Clausula::class, 'auditoria_interno_clausula', 'auditoria_id', 'clausula_id');
    }

    public function auditoriaHallazgos()
    {
        return $this->hasMany(AuditoriaInternasHallazgos::class, 'auditoria_internas_id');
    }

    public function reportes()
    {
        return $this->hasMany(AuditoriaInternasReportes::class, 'id_auditoria', 'id');
    }
}
