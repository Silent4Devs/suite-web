<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CartaAceptacion
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
 *
 * @property Empleado|null $empleado
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 *
 * @package App\Models
 */
class CartaAceptacion extends Model
{
	protected $table = 'carta_aceptacion';

	protected $casts = [
		'responsable_id' => 'int',
		'legal' => 'int',
		'cumplimiento' => 'int',
		'operacional' => 'int',
		'reputacional' => 'int',
		'financiero' => 'int',
		'tecnologico' => 'int',
		'controles_id' => 'int',
		'director_resp_id' => 'int',
		'vp_responsable_id' => 'int',
		'presidencia_id' => 'int',
		'vice_operaciones_id' => 'int'
	];

	protected $dates = [
		'fecharegistro',
		'fechaaprobacion',
		'fecha_aut_direct',
		'fecha_vp_aut',
		'fecha_aut_presidencia',
		'fecha_aut_viceoperaciones'
	];

	protected $fillable = [
		'folio_riesgo',
		'fecharegistro',
		'fechaaprobacion',
		'responsable_id',
		'activo_folio',
		'nombre_activo',
		'criticidad_activo',
		'confidencialidad',
		'descripcion_negocio',
		'descripcion_tecnologico',
        'descripcion_riesgo',
		'legal',
		'cumplimiento',
		'operacional',
		'reputacional',
		'financiero',
		'tecnologico',
		'aceptacion_riesgo',
		'hallazgo',
		'controles_compensatorios',
		'recomendaciones',
		'director_resp_id',
		'fecha_aut_direct',
		'vp_responsable_id',
		'fecha_vp_aut',
		'presidencia_id',
		'fecha_aut_presidencia',
		'vice_operaciones_id',
		'fecha_aut_viceoperaciones'
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

	public function responsables()
	{
		return $this->belongsTo(Empleado::class, 'responsable_id','id');
	}

    public function directores()
	{
		return $this->belongsTo(Empleado::class, 'director_resp_id','id');
	}

    public function presidentes()
	{
		return $this->belongsTo(Empleado::class, 'presidencia_id','id');
	}

    public function vicepresidentes()
	{
		return $this->belongsTo(Empleado::class, 'vp_responsable_id','id');
	}

    public function vicepresidentesOperaciones()
	{
		return $this->belongsTo(Empleado::class, 'vice_operaciones_id','id');
	}

    public function controles()
	{
		return $this->hasMany(CartaAceptacionPivot::class,'carta_id','id');
	}


}
