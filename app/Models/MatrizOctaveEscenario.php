<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrizOctaveEscenario extends Model
{

    use SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'matriz_octave_escenarios';


    protected $fillable = [
        'nom_escenario',
        'descripcion',
        'confidencialidad',
        'integridad',
        'disponibilidad',
    ];

    public function matriz_octave_contenedor()
    {
        return $this->hasMany(MatrizOctaveContenedor::class, 'id_matriz_octave_escenarios');
    }
}
