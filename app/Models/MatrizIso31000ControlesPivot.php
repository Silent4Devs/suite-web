<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class MatrizIso31000ControlesPivot.
 *
 * @property int $id
 * @property int|null $id_matriz31000
 * @property int|null $controles_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property MatrizIso31000|null $matriz_iso31000
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 */
class MatrizIso31000ControlesPivot extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'matriz_iso31000_controles_pivots';

    protected $casts = [
        'id_matriz31000' => 'int',
        'controles_id' => 'int',
    ];

    protected $fillable = [
        'id_matriz31000',
        'controles_id',
    ];

    public function matriz_iso31000()
    {
        return $this->belongsTo(MatrizIso31000::class, 'id_matriz31000');
    }

    public function declaracion_aplicabilidad()
    {
        return $this->belongsTo(DeclaracionAplicabilidad::class, 'controles_id');
    }
}
