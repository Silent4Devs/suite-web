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

    public static function getAll()
    {
        return Cache::remember('TimesheetProyectoEmpleado:timesheetproyectoempleado_all', 3600 * 4, function () {
            return self::orderBy('id')->get();
        });
    }

    public static function getIdAreaTimeProy($proyecto_id)
    {
        return
            Cache::remember('TimesheetProyectoEmpleado:getIdAreaTimeProy_'.$proyecto_id, 3600 * 2, function () {
                return self::select('id', 'area_id')->orderBy('id')->get();
            });
    }

    public static function getAllByEmpleadoIdNoBloqueado($empleado_id)
    {
        return
            Cache::remember('GetAllByEmpleadoId_'.$empleado_id, 3600 * 1, function () use ($empleado_id) {
                return self::with('empleado')->where('empleado_id', $empleado_id)->where('usuario_bloqueado', false)->get();
            });
    }

    public static function getAllByEmpleadoIdExistsNoBloqueado($empleado_id)
    {
        return
            Cache::remember('GetAllByEmpleadoIdExists_'.$empleado_id, 3600 * 1, function () use ($empleado_id) {
                return self::where('empleado_id', $empleado_id)->where('usuario_bloqueado', false)->exists();
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
