<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestasEvaluacionAnalisisBrechas extends Model
{
    use HasFactory;

    protected $table = 'respuestas_evaluacion_analisis_brechas';

    protected $fillable = [
        'pregunta_id',
        'parametro_id',
        'evidencia',
        'recomendacion',
    ];

    public $timestamps = false;

    public function parametro()
    {
        return $this->belongsTo(ParametrosTemplateAnalisisdeBrechas::class, 'parametro_id', 'id');
    }

    public function preguntas()
    {
        return $this->belongsTo(PreguntasTemplateAnalisisdeBrechas::class, 'pregunta_id', 'id');
    }

    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionTemplatesAnalisisBrechas::class, 'ev_analisis_template_id', 'id');
    }
}
