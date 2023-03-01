<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GapTresSedatu extends Model
{
	use SoftDeletes;
	protected $table = 'gap_tres_sedatu';

	protected $casts = [
		'analisis_brechas_id' => 'int'
	];

	protected $fillable = [
		'estado',
		'contexto',
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
