<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class EvaluacionObjetivo.
 *
 * @property int $id
 * @property character varying|null $no
 * @property character varying|null $evaluacion
 * @property Carbon|null $fecha
 * @property int|null $resultado
 * @property int|null $id_objetivo
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property Objetivosseguridad|null $objetivosseguridad
 */
class EvaluacionObjetivo extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'evaluacion_objetivo';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $casts = [
        'no' => 'int',
        'evaluacion' => 'string',
        'resultado' => 'int',
        'id_objetivo' => 'int',
    ];

    protected $dates = [
        'fecha',
        'deleted_at',
    ];

    protected $fillable = [
        'no',
        'evaluacion',
        'fecha',
        'resultado',
        'id_objetivo',
    ];

    public function objetivosseguridad()
    {
        return $this->belongsTo(Objetivosseguridad::class, 'id_objetivo');
    }
}
