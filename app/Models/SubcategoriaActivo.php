<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

/**
 * Class SubcategoriaActivo.
 *
 * @property int $id
 * @property character varying $subcategoria
 * @property int $categoria_id
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property Tipoactivo $tipoactivo
 */
class SubcategoriaActivo extends Model
{
    use SoftDeletes;

    protected $table = 'subcategoria_activos';

    protected $casts = [
        'subcategoria' => 'string',
        'categoria_id' => 'int',
    ];

    protected $fillable = [
        'subcategoria',
        'categoria_id',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('SubCategoriaActivo_all', 3600 * 24, function () {
            return self::get();
        });
    }

    public function tipoactivo()
    {
        return $this->belongsTo(Tipoactivo::class, 'categoria_id');
    }
}
