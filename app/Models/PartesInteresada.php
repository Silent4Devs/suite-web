<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class PartesInteresada extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    public $table = 'partes_interesadas';

    public static $searchable = [
        'parteinteresada',
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

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'parteinteresada',
        'requisitos',
        'clausula',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function clausulas()
    {
        return $this->belongsToMany(Clausula::class, 'partes_interesadas_clausula', 'partesint_id', 'clausula_id');
    }
}
