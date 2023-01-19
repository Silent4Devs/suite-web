<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitudDayOff extends Model
{
    
    use SoftDeletes;

    public $table = 'solicitud_dayoff';

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
        return $this->belongsTo(Empleado::class,'empleado_id');
    }
}
