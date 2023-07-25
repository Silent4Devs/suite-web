<?php

namespace App\Models;

//use Eloquent as Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenaza extends Model
{
    use SoftDeletes;
    public $table = 'amenazas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombre',
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
        'categoria' => 'string',
        'descripcion' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'categoria' => 'nullable|string|max:255',
        'descripcion' => 'nullable|string|max:1255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function matriz_riesgos()
    {
        return $this->hasMany(MatrizRiesgo::class, 'id_amenaza');
    }

    public function vulnerabilidads()
    {
        return $this->hasMany(Vulnerabilidad::class, 'id_amenaza');
    }
}
