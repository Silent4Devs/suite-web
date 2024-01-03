<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionTemplatesAnalisisBrechas extends Model
{
    use HasFactory;

    protected $table = 'evaluacion_templates_analisis_brechas';

    protected $fillable = [
        'analisis_brechas_id',
        'template_id',
    ];

    public function respuestas()
    {
        return $this->hasMany(RespuestasEvaluacionAnalisisBrechas::class, 'ev_analisis_template_id', 'id');
    }
}
