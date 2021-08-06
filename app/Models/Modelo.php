<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Modelo
 *
 * @property int $id
 * @property int|null $marca_id
 * @property string|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Marca|null $marca
 *
 * @package App\Models
 */
class Modelo extends Model
{
	use SoftDeletes;
	protected $table = 'modelo';

	protected $casts = [
		'marca_id' => 'int'
	];

	protected $fillable = [
		'marca_id',
		'nombre'
	];

	public function marca()
	{
		return $this->belongsTo(Marca::class);
	}

}
