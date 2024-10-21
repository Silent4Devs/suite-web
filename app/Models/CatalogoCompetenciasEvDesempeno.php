<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoCompetenciasEvDesempeno extends Model
{
    use HasFactory;

    protected $table = 'catalogo_competencias_ev_desempenos';

    protected $fillable = [
        'competencia',
        'descripcion_competencia',
        'tipo_competencia',
        'nivel_esperado',
    ];

    public function ponderaciones()
    {
        return $this->hasMany(ConductasCompCuestionarioEvDesempenos::class, 'competencia_id', 'id');
    }
}
