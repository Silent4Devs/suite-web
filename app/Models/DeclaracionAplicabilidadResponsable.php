<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DeclaracionAplicabilidadResponsable
 * 
 * @property int $id
 * @property int|null $declaracion_id
 * @property int|null $empleado_id
 * @property character varying|null $aplica
 * @property string|null $justificacion
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 * @property Empleado|null $empleado
 *
 * @package App\Models
 */
class DeclaracionAplicabilidadResponsable extends Model
{
	use SoftDeletes;
	protected $table = 'declaracion_aplicabilidad_responsables';

	protected $casts = [
		'declaracion_id' => 'int',
		'empleado_id' => 'int',
		'aplica' => 'character varying',
		'created_at' => 'timestamp without time zone',
		'updated_at' => 'timestamp without time zone'
	];

	protected $fillable = [
		'declaracion_id',
		'empleado_id',
		'aplica',
		'justificacion'
	];

	public function declaracion_aplicabilidad()
	{
		return $this->belongsTo(DeclaracionAplicabilidad::class, 'declaracion_id');
	}

	public function empleado()
	{
		return $this->belongsTo(Empleado::class);
	}
}
