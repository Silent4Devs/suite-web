<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $table = 'timesheet';

    protected $appends = ['semana'];

    protected $fillable = [
        'fecha_semana',
        'fecha_dia',
        'aprobado',
        'empleado_id',
        'aprobador_id',
        'aprobado',
        'rechazado',
        'estatus',
        'comentarios',
        'dia_semana',
        'inicio_semana',
        'fin_semana',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
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
            <font style="font-weight: lighter !important;"> Del </font>
            <font style="font-weight: bolder !important;">' . $inicio_dia . '</font> 
            <font style="font-weight: lighter !important;"> al </font> 
            <font style="font-weight: bolder !important;">' . $fin_dia . '<font>

            ';
        
        return $semana_rango;
    }

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
}
