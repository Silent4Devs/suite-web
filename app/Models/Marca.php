<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Marca.
 *
 * @property int $id
 * @property int|null $activo_id
 * @property string|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Tipoactivo|null $tipoactivo
 * @property Collection|Modelo[] $modelos
 */
class Marca extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'marca';

    protected $casts = [
        'activo_id' => 'int',
    ];

    protected $fillable = [
        'activo_id',
        'nombre',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('Marcas_all', 3600 * 24, function () {
            return self::get();
        });
    }

    public function tipoactivo()
    {
        return $this->belongsTo(Tipoactivo::class, 'activo_id');
    }

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}
