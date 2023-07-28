<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Matriz31000ActivosInfo.
 *
 * @property int $id
 * @property string|null $contenedor_activos
 * @property int|null $id_amenaza
 * @property int|null $id_vulnerabilidad
 * @property int|null $id_matriz31000
 * @property string|null $escenario_riesgo
 * @property int|null $confidencialidad
 * @property int|null $disponibilidad
 * @property int|null $integridad
 * @property int|null $evaluación_riesgo
 * @property int|null $activo_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Amenaza|null $amenaza
 * @property Vulnerabilidad|null $vulnerabilidad
 * @property MatrizIso31000|null $matriz_iso31000
 * @property Activo|null $activo
 */
class Matriz31000ActivosInfo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'matriz31000_activos_info';

    protected $casts = [
        'id_amenaza' => 'int',
        'id_vulnerabilidad' => 'int',
        'id_matriz31000' => 'int',
        'confidencialidad' => 'int',
        'disponibilidad' => 'int',
        'integridad' => 'int',
        'evaluación_riesgo' => 'int',
        'activo_id' => 'int',
    ];

    protected $fillable = [
        'contenedor_activos',
        'id_amenaza',
        'id_vulnerabilidad',
        'id_matriz31000',
        'escenario_riesgo',
        'confidencialidad',
        'disponibilidad',
        'integridad',
        'evaluación_riesgo',
        'activo_id',
    ];

    public function amenaza()
    {
        return $this->belongsTo(Amenaza::class, 'id_amenaza');
    }

    public function vulnerabilidad()
    {
        return $this->belongsTo(Vulnerabilidad::class, 'id_vulnerabilidad');
    }

    public function matriz_iso31000()
    {
        return $this->belongsTo(MatrizIso31000::class, 'id_matriz31000');
    }

    public function activo()
    {
        return $this->belongsTo(Activo::class);
    }
}
