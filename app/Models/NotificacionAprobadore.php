<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class NotificacionAprobadore.
 *
 * @property int $id
 * @property int|null $declaracion_id
 * @property int|null $aprobadores_id
 * @property int|null $responsables_id
 * @property bool|null $indicador_aprobador
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 * @property DeclaracionAplicabilidadAprobadores|null $declaracion_aplicabilidad_aprobadore
 * @property DeclaracionAplicabilidadResponsable|null $declaracion_aplicabilidad_responsable
 */
class NotificacionAprobadore extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'notificacion_aprobadores';

    protected $casts = [
        'declaracion_id' => 'int',
        'aprobadores_id' => 'int',
        'responsables_id' => 'int',
        'indicador_aprobador' => 'bool',
        'created_at' => 'timestamp without time zone',
        'updated_at' => 'timestamp without time zone',
    ];

    protected $fillable = [
        'declaracion_id',
        'aprobadores_id',
        'responsables_id',
        'indicador_aprobador',
        'correo_aprobadores',
        'correo_responsables',
    ];

    public function declaracion_aplicabilidad()
    {
        return $this->belongsTo(DeclaracionAplicabilidad::class, 'declaracion_id');
    }

    public function declaracion_aplicabilidad_aprobadore()
    {
        return $this->belongsTo(DeclaracionAplicabilidadAprobadores::class, 'aprobadores_id');
    }

    public function declaracion_aplicabilidad_responsable()
    {
        return $this->belongsTo(DeclaracionAplicabilidadResponsable::class, 'responsables_id');
    }
}
