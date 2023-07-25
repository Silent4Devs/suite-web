<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language.
 *
 * @property int $id
 * @property character varying|null $idioma
 * @property int|null $id_puesto
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property Puesto|null $puesto
 */
class Language extends Model
{
    protected $table = 'languages';

    protected $casts = [
        'idioma' => 'string',

    ];

    protected $fillable = [
        'idioma',

    ];

    public function puesto()
    {
        return $this->belongsToMany('\App\Puesto', 'puesto_idioma_porcentaje_pivot')
            ->withPivot('id_puesto');
    }

    public function idiomaEmpleado()
    {
        return $this->belongsToMany('\App\Empleado', 'idioma_empleado')
            ->withPivot('empleado_id');
    }
}
