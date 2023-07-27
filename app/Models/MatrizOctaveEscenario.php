<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class MatrizOctaveEscenario extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'matriz_octave_escenarios';

    protected $appends = ['name', 'content', 'color', 'sumatoria'];

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

    public function getColorAttribute()
    {
        $suma = $this->confidencialidad + $this->integridad + $this->disponibilidad;
        if ($suma <= 5) {
            return '#0C7000';
        } elseif ($suma <= 10) {
            return '#2BE015';
        } elseif ($suma <= 15) {
            return '#FFFF00';
        } elseif ($suma <= 20) {
            return '#FF7000';
        } else {
            return '#FF0000';
        }
    }

    public function getNameAttribute()
    {
        return $this->identificador_escenario . ' ' . $this->nom_escenario;
    }

    public function getContentAttribute()
    {
        return Str::limit($this->descripcion, 20, '...') ? Str::limit($this->descripcion, 20, '...') : 'Sin Contenido';
    }

    public function controles()
    {
        return $this->belongsToMany(DeclaracionAplicabilidad::class, 'matriz_octave_escenario_controles', 'id_matriz_octave_escenarios', 'controles_id');
    }

    public function getSumatoriaAttribute()
    {
        return round(($this->confidencialidad + $this->integridad + $this->disponibilidad) / 3);
    }

    public function children()
    {
        return $this->belongsToMany(DeclaracionAplicabilidad::class, 'matriz_octave_escenario_controles', 'id_matriz_octave_escenarios', 'controles_id');
    }

    // public function matriz_octave_contenedor()
    // {
    //     return $this->hasMany(MatrizOctaveContenedor::class, 'id_matriz_octave_escenarios');
    // }
    public function contenedor()
    {
        return $this->belongsTo(MatrizOctaveContenedor::class, 'id_octave_contenedor', 'id');
    }
}
