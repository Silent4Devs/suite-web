<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Class AnalisisDeRiesgo.
 *
 * @property int $id
 * @property string $nombre
 * @property string $tipo
 * @property Carbon $fecha
 * @property string $porcentaje_implementacion
 * @property int|null $id_empleado
 * @property int $estatus
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Empleado|null $empleado
 * @property Collection|MatrizRiesgo[] $matriz_riesgos
 */
class AnalisisDeRiesgo extends Model
{
    use SoftDeletes;
    // use QueryCacheable;

    // public $cacheFor = 3600;
    // protected static $flushCacheOnUpdate = true;
    protected $table = 'analisis_de_riesgo';

    protected $casts = [
        'id_empleado' => 'int',
        'estatus' => 'int',
    ];

    protected $dates = [
        'fecha',
    ];

    protected $fillable = [
        'nombre',
        'tipo',
        'fecha',
        'porcentaje_implementacion',
        'id_empleado',
        'estatus',
    ];

    const TipoSelect = [
        'Seguridad de la información' => 'Seguridad de la información',
        'AMEF'     => 'AMEF',
    ];

    const EstatusSelect = [
        '1' => 'Vigente',
        '2' => 'Obsoleto',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function matriz_riesgos()
    {
        return $this->hasMany(MatrizRiesgo::class, 'id_analisis');
    }
}
