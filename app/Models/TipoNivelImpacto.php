<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoNivelImpacto.
 *
 * @property int $id
 * @property int|null $tabla_impacto_id
 * @property int|null $niveles_impacto_id
 * @property string|null $contenido
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TablaImpacto|null $tabla_impacto
 * @property NivelesImpacto|null $niveles_impacto
 */
class TipoNivelImpacto extends Model
{
    protected $table = 'tipo_nivel_impacto';

    protected $casts = [
        'tipo_impacto_id' => 'int',
        'niveles_impacto_id' => 'int',
    ];

    protected $fillable = [
        'tipo_impacto_id',
        'niveles_impacto_id',
        'contenido',
    ];

    public function tipo_impacto()
    {
        return $this->belongsTo(TipoImpacto::class);
    }

    public function niveles_impacto()
    {
        return $this->belongsTo(NivelesImpacto::class);
    }
}
