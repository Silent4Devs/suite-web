<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Norma.
 *
 * @property int $id
 * @property character varying $norma
 * @property character varying $descripcion
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property Collection|PartesInteresada[] $partes_interesadas
 */
class Norma extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'normas';

    protected $casts = [
        'norma' => 'string',
        'descripcion' => 'string',
    ];

    protected $fillable = [
        'norma',
        'descripcion',
    ];

    public function partes_interesadas()
    {
        return $this->hasMany(PartesInteresada::class);
    }

    public function alcance()
    {
        return $this->hasMany(AlcanceSgsi::class);
    }

    public function objetivos()
    {
        return $this->hasMany(Objetivosseguridad::class);
    }
}
