<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class VariablesObjetivosseguridad.
 *
 * @property int $id
 * @property int|null $id_objetivo
 * @property character varying|null $variable
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property Objetivosseguridad|null $objetivosseguridad
 */
class VariablesObjetivosseguridad extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'variables_objetivosseguridad';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $casts = [
        'id_objetivo' => 'int',
        'variable' => 'string',
    ];

    protected $fillable = [
        'id_objetivo',
        'variable',
    ];

    public function objetivosseguridad()
    {
        return $this->belongsTo(Objetivosseguridad::class, 'id_objetivo');
    }
}
