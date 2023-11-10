<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CartaAceptacionAprobacione.
 *
 * @property int $id
 * @property int $aprobador_id
 * @property string $autoridad
 * @property string|null $comentarios
 * @property string $firma
 * @property int $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Empleado $empleado
 */
class CartaAceptacionAprobacione extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'carta_aceptacion_aprobaciones';

    protected $casts = [
        'aprobador_id' => 'int',
        'estado' => 'int',
    ];

    protected $fillable = [
        'aprobador_id',
        'autoridad',
        'comentarios',
        'firma',
        'estado',
        'carta_id',
        'fecha_aprobacion',
        'nivel',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'aprobador_id')->alta();
    }

    public function carta()
    {
        return $this->belongsTo(CartaAceptacion::class, 'carta_id');
    }

    public function aprobacionesActivo()
    {
        return $this->hasMany(ActivosInformacionAprobacione::class, 'carta_aceptacion_aprobacion_id');
    }
}
