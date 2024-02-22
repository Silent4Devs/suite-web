<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class RespuestasEvaluacionAnalisisBrechas extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'respuestas_evaluacion_analisis_brechas';

    protected $fillable = [
        'pregunta_id',
        'parametro_id',
        'evidencia',
        'recomendacion',
        'ev_analisis_template_id',
    ];

    public $timestamps = false;

    public function parametro()
    {
        return $this->belongsTo(ParametrosEvaluacionAnalisisBrechas::class, 'parametro_id', 'id');
    }

    public function preguntas()
    {
        return $this->belongsTo(PreguntasEvaluacionAnalisisBrechas::class, 'pregunta_id', 'id');
    }

    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionAnalisisBrechas::class, 'ev_analisis_template_id', 'id');
    }
}
