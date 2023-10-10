<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Objetivosseguridad.
 *
 * @property int $id
 * @property character varying $objetivoseguridad
 * @property character varying|null $indicador
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $team_id
 * @property int|null $responsable_id
 * @property character varying|null $formula
 * @property character varying|null $verde
 * @property character varying|null $amarillo
 * @property character varying|null $rojo
 * @property character varying|null $unidadmedida
 * @property character varying|null $meta
 * @property character varying|null $frecuencia
 * @property character varying|null $revisiones
 * @property int|null $ano
 * @property Team|null $team
 * @property Empleado|null $empleado
 * @property Collection|VariablesObjetivosseguridad[] $variables_objetivosseguridads
 * @property Collection|EvaluacionObjetivo[] $evaluacion_objetivos
 */
class Objetivosseguridad extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'objetivosseguridads';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $casts = [
        'objetivoseguridad' => 'string',
        'indicador' => 'string',
        'team_id' => 'int',
        'responsable_id' => 'int',
        'formula' => 'string',
        'verde' => 'string',
        'amarillo' => 'string',
        'rojo' => 'string',
        'unidadmedida' => 'string',
        'meta' => 'string',
        'frecuencia' => 'string',
        'revisiones' => 'string',
    ];

    protected $fillable = [
        'objetivoseguridad',
        'indicador',
        'team_id',
        'responsable_id',
        'formula',
        'verde',
        'amarillo',
        'rojo',
        'unidadmedida',
        'meta',
        'frecuencia',
        'revisiones',
        'ano',
        'tipo_objetivo_sistema_id',
        'norma_id',
        'objetivo_id',

    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'responsable_id')->alta();
    }

    public function variables_objetivosseguridads()
    {
        return $this->hasMany(VariablesObjetivosseguridad::class, 'id_objetivo');
    }

    public function evaluacion_objetivos()
    {
        return $this->hasMany(EvaluacionObjetivo::class, 'id_objetivo');
    }

    public function tipo_objetivo_sistema()
    {
        return $this->belongsTo(TiposObjetivosSistema::class, 'tipo_objetivo_sistema_id');
    }

    public function norma()
    {
        return $this->belongsTo(Norma::class);
    }

    public function normas()
    {
        return $this->belongsToMany(Norma::class, 'normas_objetivos', 'objetivo_id', 'norma_id');
    }
}
