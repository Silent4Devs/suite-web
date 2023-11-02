<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
