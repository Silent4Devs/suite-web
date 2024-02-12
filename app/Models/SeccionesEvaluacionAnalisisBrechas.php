<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionesEvaluacionAnalisisBrechas extends Model
{
    use HasFactory;

    public $table = 'secciones_evaluacion_analisis_brechas';

    public $fillable = [
        'evaluacion_id',
        'numero_seccion',
        'descripcion',
        'porcentaje_seccion',
    ];

    //Relaciones

    public function preguntas()
    {
        return $this->hasMany(PreguntasEvaluacionAnalisisBrechas::class, 'seccion_id', 'id');
    }
}
