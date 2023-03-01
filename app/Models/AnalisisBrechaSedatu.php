<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AnalisisBrechaSedatu extends Model
{
	use SoftDeletes;
	protected $table = 'analisis_brecha_sedatu';

	protected $casts = [
		'nombre' => 'string',
        'porcentaje_implementacion' => 'string',
        'id_elaboro' => 'int',
        'estatus' => 'int',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
	];

	protected $dates = [
		'fecha'
	];

	protected $fillable = [
		'nombre',
		'fecha',
		'porcentaje_implementacion',
		'id_elaboro',
		'estatus'
	];

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'id_elaboro');
	}

	public function gap_uno_sedatu()
	{
		return $this->hasMany(GapUnoSedatu::class, 'analisis_brechas_id');
	}

	public function gap_dos_sedatu()
	{
		return $this->hasMany(GapDosSedatu::class, 'analisis_brechas_id');
	}

	public function gap_tres_sedatu()
	{
		return $this->hasMany(GapTresSedatu::class, 'analisis_brechas_id');
	}
}
