<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitudVacaciones extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'solicitud_vacaciones';

    public $fillable = [
        'dias_solicitados',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'aprobacion',
        'empleado_id',
        'año',
        'autoriza',
        'comentarios_aprobador',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
