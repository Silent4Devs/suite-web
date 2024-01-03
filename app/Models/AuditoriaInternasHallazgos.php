<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AuditoriaInternasHallazgos extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    public $table = 'auditoria_internas_hallazgos';

    protected $fillable = [
        'incumplimiento_requisito',
        'descripcion',
        'clasificacion_hallazgo',
        'auditoria_internas_id',
        'area_id',
        'proceso_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'no_tipo',
        'titulo',
        'clasificacion_id',
        'clausula_id',
        'reporte_id',
    ];

    public function auditoriaInterna()
    {
        return $this->belongsTo(AuditoriaInterna::class, 'auditoria_internas_id');
    }

    public function procesos()
    {
        return $this->belongsTo(Proceso::class, 'proceso_id');
    }

    public function areas()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function clasificacion()
    {
        return $this->belongsTo(ClasificacionesAuditorias::class, 'clasificacion_id');
    }

    public function clausula()
    {
        return $this->belongsTo(ClausulasAuditorias::class, 'clausula_id');
    }

    public function reporte()
    {
        return $this->belongsTo(AuditoriaInternasReportes::class, 'reporte_id', 'id');
    }
}
