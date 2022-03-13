<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatrizOctaveEscenario extends Model
{
    use SoftDeletes;

    protected $table = 'matriz_octave_escenarios';

    protected $fillable = [
        'identificador_escenario',
        'nom_escenario',
        'descripcion',
        'confidencialidad',
        'integridad',
        'disponibilidad',
        'controles',
        'id_octave_contenedor',
    ];

    /**
     * The controles that belong to the MatrizOctaveEscenario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function controles()
    {
        return $this->belongsToMany(DeclaracionAplicabilidad::class, 'matriz_octave_escenario_controles', 'id_matriz_octave_escenarios', 'controles_id');
    }
    // public function matriz_octave_contenedor()
    // {
    //     return $this->hasMany(MatrizOctaveContenedor::class, 'id_matriz_octave_escenarios');
    // }
}
