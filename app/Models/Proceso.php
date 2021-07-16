<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Proceso
 *
 * @property int $id
 * @property string|null $codigo
 * @property string|null $nombre
 * @property int|null $id_macroproceso
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Macroproceso|null $macroproceso
 *
 * @package App\Models
 */
class Proceso extends Model
{
	use SoftDeletes;
	protected $table = 'procesos';

	protected $casts = [
		'id_macroproceso' => 'int'
	];

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const ACTIVO = '1';
    const NO_ACTIVO = '2';

	protected $fillable = [
		'codigo',
		'nombre',
		'id_macroproceso',
		'descripcion',
        'estatus',
        'documento_id'

	];

	public function macroproceso()
	{
		return $this->belongsTo(Macroproceso::class, 'id_macroproceso');
	}

    public function documento()
	{
		return $this->belongsTo(Documento::class,'documento_id','id');
	}

    public function vistaDocumento()
	{
		return $this->belongsToMany(Documento::class);
	}




}
