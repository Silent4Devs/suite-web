<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Glosario extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'glosarios';

    public static $searchable = [
        'concepto',
    ];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'numero',
        'norma',
        'concepto',
        'definicion',
        'explicacion',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'numero' => 'string',
        'norma' => 'string',
        'concepto' => 'string',
        'definicion' => 'string',
        'explicacion' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'numero' => 'nullable|string|max:255',
        'norma' => 'nullable|string|max:255',
        'concepto' => 'nullable|string|max:255',
        'defincion' => 'nullable|string|max:255',
        'explicacion' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
    ];
}
