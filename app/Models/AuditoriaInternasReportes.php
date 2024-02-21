<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaInternasReportes extends Model
{
    use HasFactory;

    public $table = 'auditoria_internas_reportes';

    protected $fillable = [
        'id_auditoria',
        'empleado_id',
        'lider_id',
        'comentarios',
        'estado',
        'firma',
        'reporte_id',
        'firma_empleado',
        'firma_lider',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->alta();
    }

    public function lider()
    {
        return $this->belongsTo(Empleado::class, 'lider_id')->alta();
    }

    public function hallazgos()
    {
        return $this->hasMany(AuditoriaInternasHallazgos::class, 'reporte_id', 'id');
    }
}
