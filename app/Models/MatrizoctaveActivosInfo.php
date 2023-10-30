<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class MatrizoctaveActivosInfo.
 *
 * @property int $id
 * @property string|null $nombre_ai
 * @property int|null $valor_criticidad
 * @property string|null $contenedor_activos
 * @property int|null $id_amenaza
 * @property int|null $id_octave
 * @property int|null $id_vulnerabilidad
 * @property string|null $escenario_riesgo
 * @property int|null $id_custodio
 * @property int|null $id_dueno
 * @property int|null $confidencialidad
 * @property int|null $disponibilidad
 * @property int|null $integridad
 * @property int|null $evaluacion_riesgo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Amenaza|null $amenaza
 * @property MatrizOctave|null $matriz_octave
 * @property Vulnerabilidad|null $vulnerabilidad
 * @property Empleado|null $empleado
 */
class MatrizoctaveActivosInfo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'matrizoctave_activos_info';

    protected $casts = [
        'valor_criticidad' => 'int',
        'id_amenaza' => 'int',
        'id_octave' => 'int',
        'id_vulnerabilidad' => 'int',
        'id_custodio' => 'int',
        'id_dueno' => 'int',
        'confidencialidad' => 'int',
        'disponibilidad' => 'int',
        'integridad' => 'int',
        'evaluacion_riesgo' => 'int',
    ];

    protected $fillable = [
        'nombre_ai',
        'valor_criticidad',
        'contenedor_activos',
        'id_amenaza',
        'id_octave',
        'id_vulnerabilidad',
        'escenario_riesgo',
        'id_custodio',
        'id_dueno',
        'confidencialidad',
        'disponibilidad',
        'integridad',
        'evaluacion_riesgo',
    ];

    public function amenaza()
    {
        return $this->belongsTo(Amenaza::class, 'id_amenaza');
    }

    public function matriz_octave()
    {
        return $this->belongsTo(MatrizOctave::class, 'id_octave');
    }

    public function vulnerabilidad()
    {
        return $this->belongsTo(Vulnerabilidad::class, 'id_vulnerabilidad');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_dueno')->alta();
    }
}
