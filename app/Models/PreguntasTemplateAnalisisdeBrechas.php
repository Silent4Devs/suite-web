<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PreguntasTemplateAnalisisdeBrechas extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

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
