<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConductasCompCuestionarioEvDesempenos extends Model
{
    use HasFactory;

    protected $table = 'conductas_comp_cuestionario_ev_desempenos';

    protected $fillable = [
        'pregunta_cuest_comp_ev_des_id',
        'definicion',
        'ponderacion',
    ];

    public function pregunta()
    {
        return $this->belongsTo(CuestionarioCompetenciaEvDesempeno::class, 'pregunta_cuest_comp_ev_des_id', 'id');
    }
}
