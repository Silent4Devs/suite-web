<?php

namespace App\Models;

use App\Models\Iso27\AnalisisBrechasIso;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionAnalisisBrechas extends Model
{
    use HasFactory;

    public $table = 'evaluacion_analisis_brechas';

    public $fillable = [
        'analisis_brechas_id',
        'nombre_evaluacion',
        'norma_id',
        'descripcion',
        'no_secciones',
    ];

    //Relaciones

    public function secciones()
    {
        return $this->hasMany(SeccionesEvaluacionAnalisisBrechas::class, 'evaluacion_id', 'id');
    }

    public function parametros()
    {
        return $this->hasMany(ParametrosEvaluacionAnalisisBrechas::class, 'evaluacion_id', 'id');
    }

    public function analisisBrechasIsos()
    {
        return $this->belongsTo(AnalisisBrechasIso::class, 'analisis_brechas_id', 'id');
    }
}
