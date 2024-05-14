<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PuestoIdiomaPorcentajePivot.
 *
 * @property int $id
 * @property int $id_language
 * @property int $id_puesto
 * @property int $id_porcentaje
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property Language $language
 * @property Puesto $puesto
 * @property Porcentaje $porcentaje
 * @property Collection|Puesto[] $puestos
 */
class PuestoIdiomaPorcentajePivot extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

    protected $table = 'puesto_idioma_porcentaje_pivot';

    protected $casts = [
        'id_language' => 'int',
        'id_puesto' => 'int',

    ];

    protected $fillable = [
        'id_language',
        'id_puesto',
        'porcentaje',
        'nivel',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'id_language');
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'id_puesto');
    }

    public function porcentaje()
    {
        return $this->belongsTo(Porcentaje::class, 'id_porcentaje');
    }

    public function puestos()
    {
        return $this->hasMany(Puesto::class, 'idioma_id');
    }
}
