<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class DeclaracionAplicabilidadResponsable.
 *
 * @property int $id
 * @property int|null $declaracion_id
 * @property int|null $empleado_id
 * @property character varying|null $aplica
 * @property string|null $justificacion
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * @property DeclaracionAplicabilidad|null $declaracion_aplicabilidad
 * @property Empleado|null $empleado
 */
class DeclaracionAplicabilidadResponsable extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'declaracion_aplicabilidad_responsables';

    protected $casts = [
        'declaracion_id' => 'int',
        'empleado_id' => 'int',
    ];

    protected $fillable = [
        'declaracion_id',
        'empleado_id',
        'aplica',
        'justificacion',
        'notificado',
        'esta_correo_enviado',
    ];

    public function declaracion_aplicabilidad()
    {
        return $this->belongsTo(DeclaracionAplicabilidad::class, 'declaracion_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->alta();
    }

    public function notificacion()
    {
        return $this->hasMany(NotificacionAprobadores::class, 'responsables_id', 'id');
    }
}
