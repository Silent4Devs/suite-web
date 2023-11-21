<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class MatrizOctaveControlesPivot.
 *
 * @property int $id
 * @property int|null $id_octave
 * @property int|null $controles_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property MatrizOctave|null $matriz_octave
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 */
class MatrizOctaveControlesPivot extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    protected $table = 'matriz_octave_controles_pivots';

    protected $casts = [
        'id_octave' => 'int',
        'controles_id' => 'int',
    ];

    protected $fillable = [
        'id_octave',
        'controles_id',
    ];

    public function matriz_octave()
    {
        return $this->belongsTo(MatrizOctave::class, 'id_octave');
    }

    public function declaracion_aplicabilidad()
    {
        return $this->belongsTo(DeclaracionAplicabilidad::class, 'controles_id');
    }
}
