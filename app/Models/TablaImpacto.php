<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class TablaImpacto.
 *
 * @property int $id
 * @property string|null $impacto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|NivelesImpacto[] $niveles_impactos
 * @property Collection|TipoImpacto[] $tipo_impactos
 */
class TablaImpacto extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    protected $table = 'tabla_impacto';

    protected $fillable = [
        'impacto',
    ];

    public function niveles_impactos()
    {
        return $this->hasMany(NivelesImpacto::class);
    }

    public function tipo_impactos()
    {
        return $this->hasMany(TipoImpacto::class);
    }
}
