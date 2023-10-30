<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CartaAceptacion.
 *
 * @property int $id
 * @property string|null $folio_riesgo
 * @property Carbon|null $fecharegistro
 * @property Carbon|null $fechaaprobacion
 * @property int|null $responsable_id
 * @property string|null $activo_folio
 * @property string|null $nombre_activo
 * @property string|null $criticidad_activo
 * @property string|null $confidencialidad
 * @property string|null $descripcion_negocio
 * @property string|null $descripcion_tecnologico
 * @property int|null $legal
 * @property int|null $cumplimiento
 * @property int|null $operacional
 * @property int|null $reputacional
 * @property int|null $financiero
 * @property int|null $tecnologico
 * @property string|null $aceptacion_riesgo
 * @property string|null $hallazgo
 * @property string|null $controles_compensatorios
 * @property string|null $recomendaciones
 * @property int|null $controles_id
 * @property int|null $director_resp_id
 * @property Carbon|null $fecha_aut_direct
 * @property int|null $vp_responsable_id
 * @property Carbon|null $fecha_vp_aut
 * @property int|null $presidencia_id
 * @property Carbon|null $fecha_aut_presidencia
 * @property int|null $vice_operaciones_id
 * @property Carbon|null $fecha_aut_viceoperaciones
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Empleado|null $empleado
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 */
class CartaAceptacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'carta_aceptacion';

    protected $casts = [
        'responsable_id' => 'int',
        'proceso_id' => 'int',
        'controles_id' => 'int',
        'director_resp_id' => 'int',
        'vp_responsable_id' => 'int',
        'presidencia_id' => 'int',
        'vice_operaciones_id' => 'int',
    ];

    protected $dates = [
        'fecharegistro',
        'fechaaprobacion',
        'fecha_aut_direct',
        'fecha_vp_aut',
        'fecha_aut_presidencia',
        'fecha_aut_viceoperaciones',
    ];

    protected $fillable = [
        'folio_riesgo',
        'fecharegistro',
        'fechaaprobacion',
        'responsable_id',
        'descripcion_negocio',
        'descripcion_tecnologico',
        'descripcion_riesgo',
        'aceptacion_riesgo',
        'hallazgo',
        'controles_compensatorios',
        'recomendaciones',
        'director_resp_id',
        'proceso_id',
        'fecha_aut_direct',
        'vp_responsable_id',
        'responsable_id',
        'hallazgos_auditoria',
        'fecha_vp_aut',
        'presidencia_id',
        'fecha_aut_presidencia',
        'vice_operaciones_id',
        'fecha_aut_viceoperaciones',
        'aceptado',
    ];

    public function getFecharegistroAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getFechaaprobacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getFechaautviceoperacionesAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getFechaautpresidenciaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getFechavpautAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getFechaautdirectAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function proceso()
    {
        return $this->belongsTo(MatrizOctaveProceso::class, 'proceso_id', 'id');
    }

    public function responsables()
    {
        return $this->belongsTo(Empleado::class, 'responsable_id', 'id')->alta();
    }

    public function directores()
    {
        return $this->belongsTo(Empleado::class, 'director_resp_id', 'id')->alta();
    }

    public function presidentes()
    {
        return $this->belongsTo(Empleado::class, 'presidencia_id', 'id')->alta();
    }

    public function vicepresidentes()
    {
        return $this->belongsTo(Empleado::class, 'vp_responsable_id', 'id')->alta();
    }

    public function vicepresidentesOperaciones()
    {
        return $this->belongsTo(Empleado::class, 'vice_operaciones_id', 'id')->alta();
    }

    public function controles()
    {
        return $this->hasMany(CartaAceptacionPivot::class, 'carta_id', 'id');
    }

    public function aprobaciones()
    {
        return $this->hasMany(CartaAceptacionAprobacione::class, 'carta_id', 'id');
    }
}
