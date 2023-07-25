<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

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
class Modelo extends Model
{
    use SoftDeletes;

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
        $cacheKey = 'Modelos_'.$id;

        return Cache::remember($cacheKey, 3600 * 24, function () use ($id) {
            return self::find($id);
        });
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
