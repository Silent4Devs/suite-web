<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Tipoactivo.
 *
 * @property int $id
 * @property character varying $tipo
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $team_id
 * @property Team|null $team
 * @property Collection|SubcategoriaActivo[] $subcategoria_activos
 * @property Collection|Marca[] $marcas
 * @property Collection|Activo[] $activos
 */
class Tipoactivo extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'tipoactivos';

    protected $casts = [
        'tipo' => 'string',
    ];

    protected $fillable = [
        'tipo',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('tipoactivos_all', 3600 * 24, function () {
            return self::get();
        });
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function subcategoria_activos()
    {
        return $this->hasMany(SubcategoriaActivo::class, 'categoria_id');
    }

    public function marcas()
    {
        return $this->hasMany(Marca::class, 'activo_id');
    }

    public function activos()
    {
        return $this->hasMany(Activo::class, 'subtipo_id');
    }
}
