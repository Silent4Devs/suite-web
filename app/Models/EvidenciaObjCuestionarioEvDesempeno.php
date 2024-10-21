<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenciaObjCuestionarioEvDesempeno extends Model
{
    use HasFactory;

    protected $table = 'evidencia_obj_cuestionario_ev_desempenos';

    protected $fillable =
        [
            'pregunta_cuest_obj_ev_des_id',
            'nombre_archivo',
            'comentarios',
        ];
}
