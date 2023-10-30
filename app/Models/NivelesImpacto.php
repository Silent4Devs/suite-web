<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class NivelesImpacto.
 *
 * @property int $id
 * @property string|null $nivel
 * @property string|null $clasificacion
 * @property string|null $color
 * @property int|null $tabla_impacto_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TablaImpacto|null $tabla_impacto
 * @property Collection|TipoImpacto[] $tipo_impactos
 */
class NivelesImpacto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'niveles_impacto';

    protected $casts = [
        'tabla_impacto_id' => 'int',
    ];

    protected $fillable = [
        'nivel',
        'clasificacion',
        'color',
        'tabla_impacto_id',
    ];

    public function tabla_impacto()
    {
        return $this->belongsTo(TablaImpacto::class);
    }

    public function tipo_impactos()
    {
        return $this->hasMany(TipoImpacto::class);
    }
}
