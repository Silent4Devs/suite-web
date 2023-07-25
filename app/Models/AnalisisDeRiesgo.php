<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property Empleado|null $empleado
 * @property Collection|MatrizRiesgo[] $matriz_riesgos
 */
class AnalisisDeRiesgo extends Model
{
    use SoftDeletes;

    protected $table = 'analisis_de_riesgo';

    protected $casts = [
        'id_elaboro' => 'int',
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
        'id_elaboro',
        'estatus',
    ];

    const TipoSelect = [
        'Seguridad de la información' => 'ISO 27001',
        // 'AMEF'     => 'AMEF',
        // 'OCTAVE' => 'OCTAVE',
        // 'NIST'=> 'NIST',
        // 'ISO 31000' => 'ISO 31000',
        'Análisis de riesgo integral' => 'Análisis de Riesgo Integral (ISO 27001,9001,20000)',
    ];

    const EstatusSelect = [
        '1' => 'En proceso',
        '2' => 'En revisión',
        '3' => 'Aprobado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_elaboro')->alta();
    }

    public function matriz_riesgos()
    {
        return $this->hasMany(MatrizRiesgo::class, 'id_analisis');
    }
}
