<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class TimesheetProyectoEmpleado extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
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

    protected $appends = ['total'];

    public static function getAll()
    {
        return Cache::remember('TimesheetProyectoEmpleado:timesheetproyectoempleado_all', 3600 * 4, function () {
            return self::orderBy('id')->get();
        });
    }

    public static function getProyectosEmpleadosTimesheetProyectosEmpleados()
    {
        return
            Cache::remember('TimesheetProyectoEmpleado:getProyectoEmpleadoTimesheetProyectosEmpleado', 3600 * 2, function () {
                return self::select('id', 'area_id', 'proyecto_id', 'costo_hora', 'horas_asignadas', 'empleado_id')->with('empleado', 'proyecto')->orderBy('id')->get();
            });
    }

    public static function getIdAreaTimeProy($proyecto_id)
    {
        return
            Cache::remember('TimesheetProyectoEmpleado:getIdAreaTimeProy_' . $proyecto_id, 3600 * 2, function () {
                return self::select('id', 'area_id')->orderBy('id')->get();
            });
    }

    public static function getAllByEmpleadoIdNoBloqueado($empleado_id)
    {
        return
            Cache::remember('GetAllByEmpleadoId_' . $empleado_id, 3600 * 1, function () use ($empleado_id) {
                return self::with('empleado')->where('empleado_id', $empleado_id)->where('usuario_bloqueado', false)->get();
            });
    }

    public static function getAllByEmpleadoIdExistsNoBloqueado($empleado_id)
    {
        return
            Cache::remember('GetAllByEmpleadoIdExists_' . $empleado_id, 3600 * 1, function () use ($empleado_id) {
                return self::where('empleado_id', $empleado_id)->where('usuario_bloqueado', false)->exists();
            });
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->select('id', 'name', 'area_id', 'puesto_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(TimesheetProyecto::class, 'proyecto_id');
    }

    public function getTotalAttribute()
    {
        $horas = TimesheetHoras::with('timesheet')
            ->whereHas('timesheet', function ($query) {
                $query->where('estatus', 'aprobado');
            })
            ->where('proyecto_id', $this->proyecto_id)
            ->where('empleado_id', $this->empleado_id)
            ->get();

        // Si hay horas para este empleado, sumar las horas de los diferentes días

        $total_horas = 0;

        foreach ($horas as $hora) {
            $total_horas += is_numeric($hora->horas_lunes) ? $hora->horas_lunes : 0;
            $total_horas += is_numeric($hora->horas_martes) ? $hora->horas_martes : 0;
            $total_horas += is_numeric($hora->horas_miercoles) ? $hora->horas_miercoles : 0;
            $total_horas += is_numeric($hora->horas_jueves) ? $hora->horas_jueves : 0;
            $total_horas += is_numeric($hora->horas_viernes) ? $hora->horas_viernes : 0;
            $total_horas += is_numeric($hora->horas_sabado) ? $hora->horas_sabado : 0;
            $total_horas += is_numeric($hora->horas_domingo) ? $hora->horas_domingo : 0;
            // Suma para los otros días también...
        }
        return $total_horas;
    }

    public function getSobrepasadasAttribute()
    {
        $horas = TimesheetHoras::with('timesheet')
            ->whereHas('timesheet', function ($query) {
                $query->where('estatus', 'aprobado');
            })
            ->where('proyecto_id', $this->proyecto_id)
            ->where('empleado_id', $this->empleado_id)
            ->get();

        // Si hay horas para este empleado, sumar las horas de los diferentes días

        $total_horas = 0;

        foreach ($horas as $hora) {
            $total_horas += is_numeric($hora->horas_lunes) ? $hora->horas_lunes : 0;
            $total_horas += is_numeric($hora->horas_martes) ? $hora->horas_martes : 0;
            $total_horas += is_numeric($hora->horas_miercoles) ? $hora->horas_miercoles : 0;
            $total_horas += is_numeric($hora->horas_jueves) ? $hora->horas_jueves : 0;
            $total_horas += is_numeric($hora->horas_viernes) ? $hora->horas_viernes : 0;
            $total_horas += is_numeric($hora->horas_sabado) ? $hora->horas_sabado : 0;
            $total_horas += is_numeric($hora->horas_domingo) ? $hora->horas_domingo : 0;
            // Suma para los otros días también...
        }

        $sobrepasadas = $total_horas - $this->horas_asignadas;

        if ($sobrepasadas > 0) {
            return $sobrepasadas;
        } else {
            return 0;
        }
    }
}
