<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntasTemplateAnalisisdeBrechas extends Model
{
    use HasFactory;

    public $table = 'preguntas_template_analisisde_brechas';

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
