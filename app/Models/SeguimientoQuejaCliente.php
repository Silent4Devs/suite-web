<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class SeguimientoQuejaCliente.
 *
 * @property int $id
 * @property int $queja_cliente_id
 * @property int $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property QuejasCliente $quejas_cliente
 */
class SeguimientoQuejaCliente extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'seguimiento_queja_cliente';

    protected $casts = [
        'queja_cliente_id' => 'int',
        'estado' => 'int',
    ];

    protected $fillable = [
        'queja_cliente_id',
        'estado',
    ];

    public function quejas()
    {
        return $this->belongsTo(QuejasCliente::class, 'queja_cliente_id');
    }
}
