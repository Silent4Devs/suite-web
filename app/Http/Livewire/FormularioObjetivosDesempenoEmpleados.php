<?php

namespace App\Http\Livewire;

use App\Mail\CorreoObjetivoAprobado;
use App\Mail\CorreoObjetivoRechazado;
use App\Mail\CorreoObjetivosPendientes;
use App\Models\Empleado;
use App\Models\EscalasMedicionObjetivos;
use App\Models\EscalasObjetivosDesempeno;
use App\Models\EvaluacionDesempeno;
use App\Models\PeriodoCargaObjetivos;
use App\Models\RH\MetricasObjetivo;
use App\Models\RH\Objetivo;
use App\Models\RH\ObjetivoEmpleado;
use App\Models\RH\TipoObjetivo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class FormularioObjetivosDesempenoEmpleados extends Component
{
    use LivewireAlert;

    public $id_emp;

    public $front_usuario;

    public $front_empleado;

    public $objetivos;

    public $cuentaObjPend = 0;

    public $categorias;

    public $unidades;

    public $escalas;

    public $array_escalas_objetivos = [];

    public $permiso_carga = false;

    public $mostrar = false;

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

    public $evaluacion_activa = false;

    public $minimo_objetivo = null;

    public $maximo_objetivo = null;

    public function mount($id_empleado)
    {
        $this->id_emp = $id_empleado;

        $this->evaluacion_activa = EvaluacionDesempeno::where('estatus', 1)->orWhere('estatus', 3)->first();

        $this->categorias = TipoObjetivo::get();
        $this->unidades = MetricasObjetivo::getAll();
        $this->escalas = EscalasMedicionObjetivos::get();
        foreach ($this->escalas as $key => $e) {
            $this->array_escalas_objetivos[$key] =
                [
                    'color' => $e->color,
                    'condicional' => 1,
                    'valor' => 0,
                    'parametro' => $e->parametro,
                    'color' => $e->color,
                ];
        }

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
        // $this->front_usuario = User::getCurrentUser();
        // $this->front_empleado = Empleado::getaltaAllObjetivoSupervisorChildren()->find($this->id_emp);

        $this->objetivos = ObjetivoEmpleado::getAllwithObjetivo()
            ->where('empleado_id', '=', $this->id_emp)
            ->where('papelera', false);

        $this->cuentaObjetivosPendientes();

        return view('livewire.formulario-objetivos-desempeno-empleados');
    }

    public function formularioMostraOcultar()
    {
        if ($this->mostrar == false) {
            $this->mostrar = true;
        } else {
            $this->mostrar = false;
        }
    }

    public function cuentaObjetivosPendientes()
    {
        $this->cuentaObjPend = ObjetivoEmpleado::with(['objetivo' => function ($query) {
            $query->with(['tipo', 'metrica']);
        }])->whereHas('objetivo', function ($query) {
            $query->where('esta_aprobado', '=', 0);
        })->count();
        // dd($cuentaObjPend);
    }

    public function enviarCorreo()
    {
        try {
            $usuario = User::getCurrentUser();
            $empleado = Empleado::getaltaAllObjetivoSupervisorChildren()->find($this->id_emp);

            $mail_supervisor = $usuario->empleado->supervisor->email;

            Mail::to(removeUnicodeCharacters($mail_supervisor))->queue(new CorreoObjetivosPendientes($empleado, $this->cuentaObjPend));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function revision($id_obj, $estado)
    {
        try {
            $est_obj = Objetivo::find($id_obj);
            $empleado = Empleado::getAltaDataColumns()->find($this->id_emp);

            if ($estado == 'aprobar') {
                $est_obj->update([
                    'esta_aprobado' => 1,
                ]);
                Mail::to(removeUnicodeCharacters($empleado->email))->queue(new CorreoObjetivoAprobado($empleado, $est_obj));
                $this->render();
            } elseif ($estado == 'rechazar') {
                $est_obj->update([
                    'esta_aprobado' => 2,
                ]);
                Mail::to(removeUnicodeCharacters($empleado->email))->queue(new CorreoObjetivoRechazado($empleado, $est_obj));
                $this->render();
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function crearObjetivo()
    {
        $usuario = User::getCurrentUser();

        if ($usuario->can('objetivos_estrategicos_agregar')) {
            $estatus = 1;
        } elseif ($usuario->empleado->es_supervisor) {
            $estatus = 1;
        } else {
            $estatus = 0;
        }

        $objetivo = Objetivo::create([
            'nombre' => $this->objetivo_estrategico,
            'descripcion' => $this->descripcion,
            'tipo_id' => $this->select_categoria,
            'KPI' => $this->KPI,
            'metrica_id' => $this->select_unidad,
            'empleado_id' => $this->id_emp,
            'estatus' => $estatus,
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
            EscalasObjetivosDesempeno::create([
                'id_objetivo_desempeno' => $objetivo->id,
                'condicion' => $this->array_escalas_objetivos[$key]['condicional'],
                'valor' => $this->array_escalas_objetivos[$key]['valor'],
                'parametro' => $this->array_escalas_objetivos[$key]['parametro'],
                'color' => $this->array_escalas_objetivos[$key]['color'],
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

    public function updatedSelectUnidad()
    {
        $unidadSeleccionada = $this->unidades->find($this->select_unidad);

        if ($unidadSeleccionada->valor_minimo === null || $unidadSeleccionada->valor_maximo === null) {
            $this->alert('warning', 'Valores no definidos', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'La Unidad Seleccionada no posee los valores minimo y/o maximo definidos (No podra usarse en las evaluaciones de desempeño).',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Entendido',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->minimo_objetivo = $unidadSeleccionada->valor_minimo;
            $this->maximo_objetivo = $unidadSeleccionada->valor_maximo;
        }
    }

    public function enviarPapelera($id_obj)
    {
        $objetivo = ObjetivoEmpleado::find($id_obj);

        $objetivo->update([
            'papelera' => true,
        ]);
    }
}
