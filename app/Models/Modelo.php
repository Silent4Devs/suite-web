<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Modelo.
 *
 * @property int $id
 * @property int|null $marca_id
 * @property string|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Marca|null $marca
 */
class Modelo extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'modelo';

    protected $casts = [
        'marca_id' => 'int',
    ];

    protected $fillable = [
        'marca_id',
        'nombre',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('Modelos_all', 3600 * 24, function () {
            return self::get();
        });
    }

    public static function getById($id)
    {
        $cacheKey = 'Modelos_' . $id;

        return Cache::remember($cacheKey, 3600 * 24, function () use ($id) {
            return self::find($id);
        });
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
