<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CartaAceptacionPivot.
 *
 * @property int $id
 * @property int|null $controles_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 */
class CartaAceptacionPivot extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    protected $table = 'carta_aceptacion_pivots';

    protected $casts = [
        'controles_id' => 'int',
    ];

    protected $fillable = [
        'controles_id',
        'carta_id',
    ];

    public function declaracion_aplicabilidad()
    {
        return $this->belongsTo(DeclaracionAplicabilidad::class, 'controles_id');
    }

    public function carta()
    {
        return $this->belongsTo(CartaAceptacion::class, 'carta_id');
    }
}
