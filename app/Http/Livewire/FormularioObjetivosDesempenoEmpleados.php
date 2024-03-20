<?php

namespace App\Http\Livewire;

// use App\Models\CategoriaObjetivosDesempeno;

use App\Models\EscalasMedicionObjetivos;
use App\Models\EscalasObjetivosDesempeno;
use App\Models\ObjetivosDesempenoEmpleados;
use App\Models\PeriodoCargaObjetivos;
use App\Models\RH\MetricasObjetivo;
use App\Models\RH\Objetivo;
use App\Models\RH\ObjetivoEmpleado;
use App\Models\RH\TipoObjetivo;
use Carbon\Carbon;
use Livewire\Component;

class FormularioObjetivosDesempenoEmpleados extends Component
{
    public $id_emp;

    public $objetivos;

    public $categorias;
    public $unidades;
    public $escalas;
    public $array_escalas_objetivos = [];

    public $permiso_carga = false;

    public $objetivo_estrategico = '';
    public $descripcion = '';
    public $KPI = '';
    public $select_categoria = '';
    public $select_unidad = '';

    public $nombre_unidad;
    public $minimo_unidad;
    public $maximo_unidad;

    public $ev360 = false;
    public $mensual = false;
    public $bimestral = false;
    public $trimestral = false;
    public $semestral = false;
    public $anualmente = false;
    public $abierta = false;

    public function mount($id_empleado)
    {
        $this->id_emp = $id_empleado;

        $this->categorias = TipoObjetivo::get();
        $this->unidades = MetricasObjetivo::getAll();
        $this->escalas = EscalasMedicionObjetivos::get();
        foreach ($this->escalas as $key => $e) {
            $this->array_escalas_objetivos[$key] =
                [
                    'color' => $e->color,
                    'condicional' => 1,
                    'valor' => 0,
                    'parametro_id' => $e->id,
                ];
        }
        // dd($this->array_escalas_objetivos);

        $periodo = PeriodoCargaObjetivos::first();
        $hoy = Carbon::today();

        if (isset($periodo->fecha_inicio) && isset($periodo->fecha_fin)) {
            $fecha_inicio = Carbon::parse($periodo->fecha_inicio);
            $fecha_fin = Carbon::parse($periodo->fecha_fin);

            $this->permiso_carga = $hoy->between($fecha_inicio, $fecha_fin);
        }
    }

    public function render()
    {
        $this->objetivos = ObjetivoEmpleado::getAllwithObjetivo()
            ->where('empleado_id', '=', $this->id_emp)
            ->where('papelera', false);
        // dd($this->objetivos);
        return view('livewire.formulario-objetivos-desempeno-empleados');
    }

    public function crearObjetivo()
    {
        $objetivo = Objetivo::create([
            'nombre' => $this->objetivo_estrategico,
            'descripcion' => $this->descripcion,
            'tipo_id' => $this->select_categoria,
            'KPI' => $this->KPI,
            'metrica_id' => $this->select_unidad,
            'empleado_id' => $this->id_emp,
            'estatus' => 0,
        ]);
        // dd($this->mensual);
        ObjetivoEmpleado::create([
            'empleado_id' => $this->id_emp,
            'objetivo_id' => $objetivo->id,
            'completado' => false,
            'en_curso' => false,
            'papelera' => false,
            'ev360' => $this->ev360,
            'mensual' => $this->mensual,
            'bimestral' => $this->bimestral,
            'trimestral' => $this->trimestral,
            'semestral' => $this->semestral,
            'anualmente' => $this->anualmente,
            'abierta' => $this->abierta,
        ]);
        foreach ($this->array_escalas_objetivos as $key => $esc_obj) {
            // dd($this->array_escalas_objetivos[$key]['parametro_id']);
            EscalasObjetivosDesempeno::create([
                'id_objetivo_desempeno' => $objetivo->id,
                'condicion' => $this->array_escalas_objetivos[$key]['condicional'],
                'valor' => $this->array_escalas_objetivos[$key]['valor'],
                'parametro_id' => $this->array_escalas_objetivos[$key]['parametro_id'],
            ]);
        }

        $this->resetInputsObjetivo();
        $this->resetInputsPeriodos();
        $this->resetInputsEscalas();
    }

    public function crearUnidad()
    {
        $unidad = MetricasObjetivo::create([
            'definicion' => $this->nombre_unidad,
            'valor_minimo' => $this->minimo_unidad,
            'valor_maximo' => $this->maximo_unidad,
        ]);

        $this->unidades = MetricasObjetivo::get();

        $this->resetInputsUnidad();
    }

    public function resetInputsUnidad()
    {
        $this->nombre_unidad = '';
        $this->minimo_unidad = 0;
        $this->maximo_unidad = 0;
    }

    public function resetInputsObjetivo()
    {
        $this->objetivo_estrategico = '';
        $this->descripcion = '';
        $this->KPI = '';
        $this->select_categoria = '';
        $this->select_unidad = '';
    }

    public function resetInputsPeriodos()
    {
        // $this->ev360 = false;
        // $this->mensual = false;
        // $this->bimestral = false;
        // $this->trimestral = false;
        // $this->semestral = false;
        // $this->anualmente = false;
        // $this->abierta = false;
    }

    public function resetInputsEscalas()
    {
        $this->ev360 = false;
        $this->mensual = false;
        $this->bimestral = false;
        $this->trimestral = false;
        $this->semestral = false;
        $this->anualmente = false;
        $this->abierta = false;
    }

    public function enviarPapelera($id_obj)
    {
        $objetivo = ObjetivoEmpleado::find($id_obj);

        $objetivo->update([
            'papelera' => true
        ]);
    }
}
