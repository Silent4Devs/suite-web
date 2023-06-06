<?php

namespace App\Models\Iso27;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeclaracionAplicabilidadResponsableIso extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'aplica',
        'justificacion',
        'fecha_aprobacion',
        'aprobadores_id',
        'declaracion_id',
    ];

    public function aprobadores()
    {
        return $this->hasOne(Empleado::class, 'aprobadores_id', 'id');
    }

    public function declaracion_aplicabilidad()
    {
        return $this->belongsTo(DeclaracionAplicabilidadConcentradoIso::class, 'declaracion_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'aprobadores_id')->alta();
    }

    public function notificacion()
    {
        return $this->hasMany(NotificacionAprobadores::class, 'responsables_id', 'id');
    }
}
