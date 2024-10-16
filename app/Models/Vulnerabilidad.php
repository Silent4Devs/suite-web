<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Vulnerabilidad.
 *
 * @version August 5, 2021, 7:45 pm UTC
 *
 * @property \App\Models\Amenaza $idAmenaza
 * @property string $nombre
 * @property string $descripcion
 * @property int $id_amenaza
 */
class Vulnerabilidad extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'vulnerabilidads';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombre',
        'descripcion',
        'id_amenaza',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string',
        'id_amenaza' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:255',
        'id_amenaza' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
    ];

    public static function getAll()
    {
        return Cache::remember('Vulnerabilidades:vulnerabilidad_all', 3600 * 7, function () {
            return self::orderByDesc('nombre')->get();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function idAmenaza()
    {
        return $this->belongsTo(\App\Models\Amenaza::class, 'id_amenaza');
    }

    public function matriz_riesgos()
    {
        return $this->hasMany(MatrizRiesgo::class, 'id_vulnerabilidad');
    }
}
