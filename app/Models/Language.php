<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

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
class Language extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;

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
