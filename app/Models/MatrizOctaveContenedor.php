<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatrizOctaveContenedor extends Model
{
    use SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'matriz_octave_escenarios';

    protected $fillable = [
        'nom_contenedor',
        'riesgo',
        'descripcion',
        'integridad',
        'id_matriz_octave_escenarios',
    ];

    public function matriz_octave_escenario()
    {
        return $this->belongsTo(MatrizOctaveEscenario::class, 'id_matriz_octave_escenarios', 'id');
    }
}
