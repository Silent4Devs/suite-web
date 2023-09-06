<?php

namespace App\Models\ContractManager;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AmpliacionContrato
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
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property Contrato|null $contrato
 */
class AmpliacionContrato extends Model implements Auditable
{
    use AuditableTrait;

    protected $table = 'ampliacion_contratos';

    protected $casts = [
        'contrato_id' => 'int',
        'importe' => 'float',
        'monto_total_ampliado' => 'float',
        'created_by' => 'int',
        'updated_by' => 'int',
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
        'fecha_fin',
        'created_by',
        'updated_by',
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
