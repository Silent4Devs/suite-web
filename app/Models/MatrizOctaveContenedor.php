<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class MatrizOctaveContenedor extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'matriz_octave_contenedores';

    protected $appends = ['name', 'content', 'color'];

    protected $fillable = [
        'identificador_contenedor',
        'nom_contenedor',
        'riesgo',
        'descripcion',
        'id_matriz_octave_escenarios',
        'matriz_id',
    ];

    // public function getImpactoProcesoAttribute()
    // {
    //     // dump($this->activoInformacion);
    //     if(is_object($this->activoInformacion)){
    //         if ($this->activoInformacion->count()>0){
    //             return $this->activoInformacion;
    //         }
    //     }
    //     return 0;
    // }

    public function getColorAttribute()
    {
        if (intval($this->riesgo) <= 1) {
            return '#0C7000';
        } elseif (intval($this->riesgo) == 2) {
            return '#2BE015';
        } elseif (intval($this->riesgo) == 3) {
            return '#FFFF00';
        } elseif (intval($this->riesgo) == 4) {
            return '#FF7000';
        } elseif (intval($this->riesgo) == 5) {
            return '#FF0000';
        }
    }

    public function getNameAttribute()
    {
        return $this->identificador_contenedor.' '.$this->nom_contenedor;
    }

    public function getContentAttribute()
    {
        return Str::limit($this->descripcion, 20, '...') ? Str::limit($this->descripcion, 20, '...') : 'Sin Contenido';
    }

    public function escenarios()
    {
        return $this->hasMany(MatrizOctaveEscenario::class, 'id_octave_contenedor', 'id');
    }

    public function children()
    {
        return $this->hasMany(MatrizOctaveEscenario::class, 'id_octave_contenedor', 'id')->with('children');
    }

    public function activoInformacion()
    {
        return $this->belongsToMany(ActivoInformacion::class, 'activos_contenedores', 'contenedor_id', 'activo_id');
    }
}
