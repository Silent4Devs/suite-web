<?php

namespace App\Models\Iso27;

use App\Models\Empleado;
use App\Traits\ClearsResponseCache;
use App\Models\NotificacionAprobadore;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeclaracionAplicabilidadAprobarIso extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'estatus',
        'comentarios',
        'fecha_aprobacion',
        'empleado_id',
        'declaracion_id',
        'esta_correo_enviado',
    ];

    public function gapdos()
    {
        return $this->hasOne(GapDosCatalogoIso::class, 'id', 'declaracion_id');
    }

    public function aprobador_declaracion()
    {
        return $this->hasMany(Empleado::class, 'id', 'empleado_id');
    }

    public function notificacion()
    {
        return $this->hasMany(NotificacionAprobadore::class, 'aprobadores_id', 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id')->alta();
    }

    public function declaracion()
    {
        return $this->hasOne(DeclaracionAplicabilidadConcentradoIso::class, 'declaracion_id', 'id');
    }
}
