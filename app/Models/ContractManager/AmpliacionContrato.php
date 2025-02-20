<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AmpliacionContrato.
 *
 * @property int $id
 * @property int|null $contrato_id
 * @property float|null $importe
 * @property float|null $monto_total_ampliado
 * @property Carbon|null $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Contrato|null $contrato
 */
class AmpliacionContrato extends Model implements Auditable
{
    use AuditableTrait, ClearsResponseCache;

    protected $table = 'ampliacion_contratos';

    protected $casts = [
        'contrato_id' => 'int',
        'importe' => 'float',
        'monto_total_ampliado' => 'float'
    ];

    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $fillable = [
        'contrato_id',
        'importe',
        'monto_total_ampliado',
        'fecha_inicio',
        'fecha_fin'
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
