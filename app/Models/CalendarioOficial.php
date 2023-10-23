<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalendarioOficial extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'calendarioOficial';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombre',
        'fecha',
        'categoria',
        'descripcion',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'fecha' => 'string',
        'categoria' => 'string',
        'descripcion' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'nullable|string|max:255',
        'fecha' => 'nullable|string|max:255',
        'categoria' => 'nullable|string|max:255',
        'descripcion' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
    ];

    /*
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/

    public static function getAll()
    {
        return Cache::remember('Calendario:calendario_oficial_all', 3600 * 12, function () {
            return self::get();
        });
    }
}
