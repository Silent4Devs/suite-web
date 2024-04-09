<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConductasCompCuestionarioEvDesempenos extends Model
{
    use HasFactory;

    protected $table = 'conductas_comp_cuestionario_ev_desempenos';

    protected $fillable = [
        'competencia_id',
        'definicion',
        'ponderacion',
    ];

    public function pregunta()
    {
        return $this->belongsTo(CatalogoCompetenciasEvDesempeno::class, 'competencia_id', 'id');
    }
}
