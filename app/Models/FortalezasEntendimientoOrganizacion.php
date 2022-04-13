<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FortalezasEntendimientoOrganizacion
 *
 * @property int $id
 * @property string|null $fortaleza
 * @property string|null $riesgo
 * @property int|null $foda_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property EntendimientoOrganizacion|null $entendimiento_organizacion
 *
 * @package App\Models
 */
class FortalezasEntendimientoOrganizacion extends Model
{
	protected $table = 'fortalezas_entendimiento_organizacion';

	protected $casts = [
		'foda_id' => 'int'
	];

	protected $fillable = [
		'fortaleza',
		'riesgo',
		'foda_id'
	];

	public function entendimiento_organizacion()
	{
		return $this->belongsTo(EntendimientoOrganizacion::class, 'foda_id','id');
	}
}
