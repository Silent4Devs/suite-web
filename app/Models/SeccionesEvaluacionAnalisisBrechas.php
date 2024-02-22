<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class SeccionesEvaluacionAnalisisBrechas extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
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
