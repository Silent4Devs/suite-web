<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class TimesheetProyectoArea extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'timesheet_proyectos_areas';

    protected $fillable = [
        'area_id',
        'proyecto_id',
    ];

    public static function getAll(array $options = [])
    {
        // Generate a unique cache key based on the options provided

        return Cache::remember('TimesheetProyectoArea:timesheet_proyecto_area_proyecto_all', 3600 * 8, function () {
            $query = self::orderBy('id', 'desc')->get();

            return $query;
        });
    }

    public static function getWithArea()
    {
        return Cache::remember('TimesheetProyectoArea:timesheet_with_area_all', 3600 * 6, function () {
            return self::with('area')->orderBy('id', 'desc')->get();
        });
    }

    public static function getAreasTimesheetProyectoEmpleados()
    {
        return
            Cache::remember('TimesheetProyectoArea:getAreaTimesheetProyectoEmpleado', 3600 * 2, function () {
                return self::select('id', 'area_id', 'proyecto_id')->orderBy('id')->get();
            });
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function proyecto()
    {
        return $this->belongsTo(TimesheetProyecto::class, 'proyecto_id', 'id');
    }

    public function proyectosAsignados()
    {
        return $this->belongsTo(TimesheetProyectoEmpleado::class, 'proyecto_id', 'proyecto_id');
    }
}
