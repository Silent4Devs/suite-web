<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Class IndicadoresSgsi.
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property string|null $formula
 * @property string|null $frecuencia
 * @property string|null $unidadmedida
 * @property string|null $meta
 * @property string|null $no_revisiones
 * @property string|null $resultado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $responsable_id
 * @property int|null $team_id
 * @property int|null $id_proceso
 * @property int|null $id_empleado
 * @property string|null $verde_uno
 * @property string|null $verde_dos
 * @property string|null $amarillo_uno
 * @property string|null $amarillo_dos
 * @property string|null $rojo_uno
 * @property string|null $rojo_dos
 *
 * @property Empleado|null $empleado
 * @property Proceso|null $proceso
 * @property User|null $user
 * @property Team|null $team
 * @property Collection|EvaluacionIndicador[] $evaluacion_indicadors
 */
class IndicadoresSgsi extends Model
{
    use SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'indicadores_sgsis';

    protected $casts = [
        'responsable_id' => 'int',
        'team_id' => 'int',
        'id_proceso' => 'int',
        'id_empleado' => 'int',
    ];

    protected $fillable = [
        'nombre',
        'descripcion',
        'formula',
        'frecuencia',
        'unidadmedida',
        'meta',
        'no_revisiones',
        'resultado',
        'responsable_id',
        'team_id',
        'id_proceso',
        'id_empleado',
        'verde',
        'amarillo',
        'rojo',
        'ano',
    ];

    public function getResultado()
    {
        return $this->evaluacion_indicadors()->sum('resultado');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado')->alta();
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function evaluacion_indicadors()
    {
        return $this->hasMany(EvaluacionIndicador::class, 'id_indicador');
    }
}
