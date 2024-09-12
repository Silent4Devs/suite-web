<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Timesheet extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use Filterable;
    use HasFactory;

    protected $table = 'timesheet';

    protected $appends = ['semana', 'proyectos', 'semana_y', 'semana_text', 'total_horas'];

    protected $fillable = [
        'fecha_semana',
        'fecha_dia',
        'aprobado',
        'empleado_id',
        'aprobador_id',
        'rechazado',
        'estatus',
        'comentarios',
        'dia_semana',
        'inicio_semana',
        'fin_semana',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function getPersonalTimesheetQuery()
    {
        $user = User::getCurrentUser();

        return self::orderBy('id', 'desc')->where('empleado_id', $user->empleado->id);
    }

    public static function getPersonalTimesheet()
    {
        return self::getPersonalTimesheetQuery()->latest()->get();
    }

    public static function getAll()
    {
        return Cache::remember('Timesheet:timesheet_all', now()->addHours(4), function () {
            return self::orderBy('id', 'desc')->get();
        });
    }

    public static function getreportes()
    {
        return Cache::remember('Timesheet:timesheet_reportes', now()->addHours(2), function () {
            return self::select('id', 'estatus', 'empleado_id', 'fecha_dia')->get();
        });
    }

    public static function getAllEstatus()
    {
        return Cache::remember('Timesheet:timesheet_estatus', now()->addHours(2), function () {
            return self::select('estatus')->get();
        });
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->select('id', 'name', 'area_id', 'foto');
    }

    public function aprobador()
    {
        return $this->belongsTo(Empleado::class, 'aprobador_id');
    }

    public function getSemanaAttribute()
    {
        $inicio = $this->traducirDia($this->inicio_semana);

        $fin = $this->traducirDia($this->fin_semana);

        $inicio_dia = \Carbon\Carbon::parse($this->fecha_dia)->copy()->modify("last {$inicio}")->format('d/m/Y');
        $fin_dia = \Carbon\Carbon::parse($this->fecha_dia)->copy()->format('d/m/Y');

        $semana_rango = '
            <font style="font-weight: lighter !important;"> Del </font><font style="font-weight: bolder !important;">' . $inicio_dia . '</font><font style="font-weight: lighter !important;"> al </font><font style="font-weight: bolder !important;">' . $fin_dia . '</font>';

        return $semana_rango;
    }

    public function getFinAttribute()
    {
        $fin = $this->traducirDia($this->fin_semana);

        $fin_dia = \Carbon\Carbon::parse($this->fecha_dia)->copy()->format('d/m/Y');

        return $fin_dia;
    }

    public function getFinLetrasAttribute()
    {
        $fin = $this->traducirDia($this->fin_semana);

        $fin_dia = \Carbon\Carbon::parse($this->fecha_dia)->copy()
            ->formatLocalized('%d/%b/%Y');

        return $fin_dia;
    }

    public function getInicioAttribute()
    {
        $inicio = $this->traducirDia($this->inicio_semana);

        $inicio_dia = \Carbon\Carbon::parse($this->fecha_dia)->copy()->modify("last {$inicio}")->format('d/m/Y');

        return $inicio_dia;
    }

    public function getInicioLetrasAttribute()
    {
        $inicio = $this->traducirDia($this->inicio_semana);

        $inicio_dia = \Carbon\Carbon::parse($this->fecha_dia)->copy()->modify("last {$inicio}")
            ->formatLocalized('%d/%b/%Y');

        return $inicio_dia;
    }

    public function getSemanaTextAttribute()
    {
        $inicio = $this->traducirDia($this->inicio_semana);

        $fin = $this->traducirDia($this->fin_semana);

        $inicio_dia = \Carbon\Carbon::parse($this->fecha_dia)->copy()->modify("last {$inicio}")->format('d/m/Y');
        $fin_dia = \Carbon\Carbon::parse($this->fecha_dia)->copy()->format('d/m/Y');

        $semana_rango = ' del ' . $inicio_dia . ' al ' . $fin_dia;

        return $semana_rango;
    }

    public function getSemanaYAttribute()
    {
        $inicio = $this->traducirDia($this->inicio_semana);

        $fin = $this->traducirDia($this->fin_semana);

        $inicio_dia = \Carbon\Carbon::parse($this->fecha_dia)->copy()->modify('last Monday')->format('Y-m-d');
        $fin_dia = \Carbon\Carbon::parse($this->fecha_dia)->copy()->modify('next Sunday')->format('Y-m-d');

        $semana_rango = $inicio_dia . '|' . $fin_dia;

        return $semana_rango;
    }

    /**
     * TODO: Esta funcion debería estar en la implementación de i18n.
     *
     * @return void
     */
    public function traducirDia($dia_seleccionado)
    {
        $dia = 'Monday';

        if ($dia_seleccionado == 'Martes') {
            $dia = 'Tuesday';
        }
        if ($dia_seleccionado == 'Miércoles') {
            $dia = 'Wednesday';
        }
        if ($dia_seleccionado == 'Jueves') {
            $dia = 'Thursday';
        }
        if ($dia_seleccionado == 'Viernes') {
            $dia = 'Friday';
        }
        if ($dia_seleccionado == 'Sábado') {
            $dia = 'Saturday';
        }
        if ($dia_seleccionado == 'Domingo') {
            $dia = 'Sunday';
        }

        return $dia;
    }

    public function horas()
    {
        return $this->hasMany(TimesheetHoras::class, 'timesheet_id', 'id')->orderBy('id');
    }

    /**
     * TODO: Esta funcion debería estar en un servicio.
     *
     * @return void
     */
    public function getProyectosAttribute()
    {
        $horas_id_proyectos = TimesheetHoras::where('timesheet_id', $this->id)->get();

        $proyectos = collect();
        foreach ($horas_id_proyectos as $id_proyect) {
            $proyecto = TimesheetProyecto::getAll()->find($id_proyect->proyecto_id);

            $proyectos->push($proyecto);
        }

        return $proyectos;
    }

    /**
     * TODO: Esta funcion debería estar en un servicio.
     *
     * @return void
     */
    public function getTotalHorasAttribute()
    {
        $total_horas = 0;
        $horas_time = TimesheetHoras::where('timesheet_id', $this->id)->get();
        foreach ($horas_time as $key => $horas) {
            $total_horas += floatval($horas->horas_lunes);
            $total_horas += floatval($horas->horas_martes);
            $total_horas += floatval($horas->horas_miercoles);
            $total_horas += floatval($horas->horas_jueves);
            $total_horas += floatval($horas->horas_viernes);
            $total_horas += floatval($horas->horas_sabado);
            $total_horas += floatval($horas->horas_domingo);
        }

        return $total_horas;
    }
}
