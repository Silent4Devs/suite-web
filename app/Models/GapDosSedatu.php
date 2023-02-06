<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GapDosSedatu extends Model
{
	use SoftDeletes;
	protected $table = 'gap_dos_sedatu';

	protected $casts = [
		'analisis_brechas_id' => 'int'
	];

	protected $fillable = [
		'anexo_politica',
		'anexo_descripcion',
		'valoracion',
		'evidencia',
		'recomendacion',
		'analisis_brechas_id',
		'created_at',
        'updated_at',
        'deleted_at',
	];

	public function analisis_brecha()
	{
		return $this->belongsTo(AnalisisBrechaSedatu::class, 'analisis_brechas_id');
	}
}
