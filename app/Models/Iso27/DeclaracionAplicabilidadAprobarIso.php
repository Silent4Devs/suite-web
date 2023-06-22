<?php

namespace App\Models\Iso27;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Empleado;
use App\Models\NotificacionAprobadore;
use Carbon\Carbon;
use App\Models\Iso27\DeclaracionAplicabilidadResponsableIso;


class DeclaracionAplicabilidadAprobarIso extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'estatus',
        'comentarios',
        'fecha_aprobacion',
        'empleado_id',
        'declaracion_id',
        'esta_correo_enviado'
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
