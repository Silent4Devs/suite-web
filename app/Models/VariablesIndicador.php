<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VariablesIndicador.
 *
 * @property int $id
 * @property int|null $id_indicador
 * @property string|null $variable
 * @property int|null $valor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property IndicadoresSgsi|null $indicadores_sgsi
 */
class VariablesIndicador extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'variables_indicadors';

    protected $casts = [
        'id_indicador' => 'int',
        'valor' => 'int',
    ];

    protected $fillable = [
        'id_indicador',
        'variable',
        'valor',
    ];

    public function indicadores_sgsi()
    {
        return $this->belongsTo(IndicadoresSgsi::class, 'id_indicador');
    }
}
