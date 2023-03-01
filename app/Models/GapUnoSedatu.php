<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GapUnoSedatu extends Model
{
	use SoftDeletes;
	protected $table = 'gap_uno_sedatu';

	protected $casts = [
		'analisis_brechas_id' => 'int'
	];

	protected $fillable = [
		'modulo',
		'pregunta',
		'valoracion',
		'evidencia',
		'recomendacion',
		'analisis_brechas_id'
	];

	public function analisis_brecha()
	{
		return $this->belongsTo(AnalisisBrechaSedatu::class, 'analisis_brechas_id');
	}
}
