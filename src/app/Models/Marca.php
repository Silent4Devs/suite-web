<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Class Marca.
 *
 * @property int $id
 * @property int|null $activo_id
 * @property string|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Tipoactivo|null $tipoactivo
 * @property Collection|Modelo[] $modelos
 */
class Marca extends Model
{
    use SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'marca';

    protected $casts = [
        'activo_id' => 'int',
    ];

    protected $fillable = [
        'activo_id',
        'nombre',
    ];

    public function tipoactivo()
    {
        return $this->belongsTo(Tipoactivo::class, 'activo_id');
    }

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}
