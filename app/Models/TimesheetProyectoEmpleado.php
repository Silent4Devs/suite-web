<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetProyectoEmpleado extends Model
{
    use HasFactory;

    protected $table = 'timesheet_proyectos_empleados';

    protected $fillable = [
        'proyecto_id',
        'empleado_id',
        'area_id',
        'horas_asignadas',
        'costo_hora',
        'correo_enviado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(TimesheetProyecto::class, 'proyecto_id');
    }
}
