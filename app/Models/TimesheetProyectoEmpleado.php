<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimesheetProyectoEmpleado extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'timesheet_proyectos_empleados';

    protected $fillable = [
        'proyecto_id',
        'empleado_id',
        'area_id',
        'horas_asignadas',
        'costo_hora',
        'correo_enviado',
    ];

    public static function getAllByEmpleadoId()
    {
        return
            Cache::remember('getAllByEmpleadoId_' . auth()->user()->empleado->id, 3600 * 12, function () {
                return self::get()->where('empleado_id', auth()->user()->empleado->id)->where('usuario_bloqueado', false);
            });
    }

    public static function getAllByEmpleadoIdExists()
    {
        return
            Cache::remember('getAllByEmpleadoId_' . auth()->user()->empleado->id, 3600 * 12, function () {
                return self::where('empleado_id', auth()->user()->empleado->id)->where('usuario_bloqueado', false)->exists();
            });
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(TimesheetProyecto::class, 'proyecto_id');
    }
}
