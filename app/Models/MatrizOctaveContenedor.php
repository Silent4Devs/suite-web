<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatrizOctaveContenedor extends Model
{
    use SoftDeletes;

    protected $table = 'matriz_octave_contenedores';

    protected $fillable = [
        'identificador_contenedor',
        'nom_contenedor',
        'riesgo',
        'vinculado_ai',
        'descripcion',
        'id_matriz_octave_escenarios',
    ];

    public function escenarios()
    {
        return $this->hasMany(MatrizOctaveEscenario::class, 'id_octave_contenedor', 'id');
    }



}
