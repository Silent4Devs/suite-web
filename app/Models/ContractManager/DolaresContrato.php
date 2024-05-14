<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class DolaresContrato.
 *
 * @property int $id
 * @property int|null $contrato_id
 * @property float|null $monto_dolares
 * @property float|null $maximo_dolares
 * @property float|null $minimo_dolares
 * @property string|null $valor_dolar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class DolaresContrato extends Model implements Auditable
{
    use AuditableTrait;
    use ClearsResponseCache, SoftDeletes;

    protected $table = 'dolares_contratos';

    protected $casts = [
        'contrato_id' => 'int',
        'monto_dolares' => 'float',
        'maximo_dolares' => 'float',
        'minimo_dolares' => 'float',
    ];

    protected $fillable = [
        'contrato_id',
        'monto_dolares',
        'maximo_dolares',
        'minimo_dolares',
        'valor_dolar',
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
