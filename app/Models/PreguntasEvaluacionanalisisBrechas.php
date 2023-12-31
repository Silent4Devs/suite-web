<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntasEvaluacionanalisisBrechas extends Model
{
    use HasFactory;

    public $table = 'preguntas_evaluacion_analisis_brechas';

    public $fillable = [
        'seccion_id',
        'pregunta',
        'numero_pregunta',
    ];

    public function respuesta()
    {
        return $this->hasOne(RespuestasEvaluacionAnalisisBrechas::class, 'pregunta_id', 'id');
    }
}
