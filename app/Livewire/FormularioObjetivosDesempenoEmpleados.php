<?php

namespace App\Livewire;

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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class FormularioObjetivosDesempenoEmpleados extends Component
{
    use LivewireAlert;

    protected $listeners = ['enviarPapelera', 'aprobarObjetivo', 'rechazarObjetivo'];

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

    public $nombre_edit_unidad;

    public $minimo_edit_unidad;

    public $maximo_edit_unidad;

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

    public $permisoAprobacion = false;

    protected $rules = [
        'objetivo_estrategico' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'select_categoria' => 'required|integer',
        'KPI' => 'required|string|max:255',
        'select_unidad' => 'required|integer',
        'id_emp' => 'required|integer',
        'ev360' => 'nullable|boolean',
        'mensual' => 'nullable|boolean',
        'bimestral' => 'nullable|boolean',
        'trimestral' => 'nullable|boolean',
        'semestral' => 'nullable|boolean',
        'anualmente' => 'nullable|boolean',
        'abierta' => 'nullable|boolean',
        'array_escalas_objetivos.*.condicional' => 'required|integer|between:1,5',
        'array_escalas_objetivos.*.valor' => 'required|numeric',
        'array_escalas_objetivos.*.parametro' => 'required|string|max:255',
        'array_escalas_objetivos.*.color' => 'required|string|max:7',
    ];

    private function forgetCache()
    {
        Cache::forget('ObjetivoEmpleado:get_all_with_objetivo');
        Cache::forget('Empleados:empleados_alta_all_area');
        Cache::forget('Empleados:empleados_alta_all_evaluaciones');
        Cache::forget('Empleados:empleados_all_objetivos_empleado');
        Cache::forget('Empleados:empleados_index_all');
    }

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
                    'condicional' => 0,
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

        $empleado = Empleado::where('id', $this->id_emp)->first();
        $usuario = User::getCurrentUser();
        // $usuario->can('objetivos_estrategicos_agregar')
        if ($usuario->roles->contains('title', 'Admin') || $usuario->empleado->id == $empleado->supervisor->id) {
            $this->permisoAprobacion = true;
        } else {
            $this->permisoAprobacion = false;
        }
    }

    public function render()
    {
        $this->objetivos = ObjetivoEmpleado::getAllwithObjetivo()
            ->where('empleado_id', '=', $this->id_emp)
            ->where('papelera', false);

        $this->cuentaObjetivosPendientes();

        return view('livewire.formulario-objetivos-desempeno-empleados');
    }

    public function cuentaObjetivosPendientes()
    {
        $this->cuentaObjPend = ObjetivoEmpleado::with(['objetivo' => function ($query) {
            $query->with(['tipo', 'metrica']);
        }])->whereHas('objetivo', function ($query) {
            $query->where('esta_aprobado', '=', 0);
        })->count();
    }

    public function formularioMostraOcultar()
    {
        if ($this->mostrar == false) {
            $this->mostrar = true;
        } else {
            $this->mostrar = false;
        }
    }

    public function resetInputsUnidad()
    {
        $this->nombre_edit_unidad = '';
        $this->minimo_edit_unidad = 0;
        $this->maximo_edit_unidad = 0;
    }

    public function resetInputsEditUnidad()
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
        $this->ev360 = false;
        $this->mensual = false;
        $this->bimestral = false;
        $this->trimestral = false;
        $this->semestral = false;
        $this->anualmente = false;
        $this->abierta = false;
    }

    public function resetInputsEscalas()
    {
        foreach ($this->array_escalas_objetivos as $key => $e) {
            $this->array_escalas_objetivos[$key]['condicional'] = 0;
            $this->array_escalas_objetivos[$key]['valor'] = 0;
        }
    }

    public function enviarCorreo()
    {
        try {
            $usuario = User::getCurrentUser();
            $empleado = Empleado::getaltaAllObjetivoSupervisorChildren()->find($this->id_emp);

            $mail_supervisor = $usuario->empleado->supervisor->email;

            Mail::to(removeUnicodeCharacters($mail_supervisor))->queue(new CorreoObjetivosPendientes($empleado, $this->cuentaObjPend));
        } catch (\Throwable $th) {
            $this->alert('error', 'Error al Enviar Correo', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'Ha habido un error al intentar enviar el correo, se enviara cuando el servicio vuelva a estar disponible.',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Entendido',
                'timerProgressBar' => true,
            ]);
        }
    }

    public function aprobarObjetivo($objetivoId)
    {
        try {
            $est_obj = Objetivo::find($objetivoId);
            $empleado = Empleado::getAltaDataColumns()->find($this->id_emp);

            $est_obj->update([
                'esta_aprobado' => 1,
            ]);

            $this->forgetCache();

            try {
                Mail::to(removeUnicodeCharacters($empleado->email))->queue(new CorreoObjetivoAprobado($empleado, $est_obj));
            } catch (\Throwable $th) {
                // throw $th;
                $this->alert('error', 'Error al Enviar Correo', [
                    'position' => 'center',
                    'timer' => 6000,
                    'toast' => false,
                    'text' => 'Ha habido un error al intentar enviar el correo, se enviara cuando el servicio vuelva a estar disponible.',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entendido',
                    'timerProgressBar' => true,
                ]);
            }

            $this->render();
        } catch (\Throwable $th) {
            $this->alert('error', 'Error al Aprobar Objetivo', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'Ha habido un error al intentar aprobar el objetivo, intente de nuevo.',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Entendido',
                'timerProgressBar' => true,
            ]);
        }
    }

    public function rechazarObjetivo($objetivoId)
    {
        try {
            $est_obj = Objetivo::find($objetivoId);
            $empleado = Empleado::getAltaDataColumns()->find($this->id_emp);

            $est_obj->update([
                'esta_aprobado' => 2,
            ]);

            $this->forgetCache();

            try {
                Mail::to(removeUnicodeCharacters($empleado->email))->queue(new CorreoObjetivoRechazado($empleado, $est_obj));
            } catch (\Throwable $th) {
                // throw $th;
                $this->alert('error', 'Error al Enviar Correo', [
                    'position' => 'center',
                    'timer' => 6000,
                    'toast' => false,
                    'text' => 'Ha habido un error al intentar rechazar el objetivo, intente de nuevo.',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Entendido',
                    'timerProgressBar' => true,
                ]);
            }

            $this->render();
        } catch (\Throwable $th) {
            $this->alert('error', 'Error al Rechazar Objetivo', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'Ha habido un error al intentar enviar el correo, se enviara cuando el servicio vuelva a estar disponible.',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Entendido',
                'timerProgressBar' => true,
            ]);
        }
    }

    public function crearObjetivo()
    {
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->alert('error', 'Error de validación', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'Se deben llenar todos los campos obligatorios.',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Entendido',
                'timerProgressBar' => true,
            ]);

            return;
        }

        $empleado = Empleado::where('id', $this->id_emp)->first();
        $usuario = User::getCurrentUser();
        // $usuario->can('objetivos_estrategicos_agregar')
        if ($usuario->roles->contains('title', 'Admin') || $usuario->empleado->id == $empleado->supervisor->id) {
            $estatus = 1;
        } else {
            $estatus = 0;
        }

        try {
            DB::beginTransaction();
            $objetivo = Objetivo::create([
                'nombre' => $this->objetivo_estrategico,
                'descripcion_meta' => $this->descripcion,
                'tipo_id' => intval($this->select_categoria),
                'KPI' => $this->KPI,
                'metrica_id' => intval($this->select_unidad),
                'esta_aprobado' => $estatus,
            ]);

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

            $numEscalas = count($this->array_escalas_objetivos);
            for ($i = 0; $i < $numEscalas; $i++) {
                for ($j = 0; $j < $numEscalas; $j++) {
                    if ($i != $j && $this->array_escalas_objetivos[$i]['valor'] == $this->array_escalas_objetivos[$j]['valor'] && $this->array_escalas_objetivos[$i]['condicional'] == $this->array_escalas_objetivos[$j]['condicional']) {
                        $this->alert('error', 'Error de validación', [
                            'position' => 'center',
                            'timer' => 6000,
                            'toast' => false,
                            'text' => 'No pueden existir escalas con el mismo valor y condición.',
                            'showConfirmButton' => true,
                            'confirmButtonText' => 'Entendido',
                            'timerProgressBar' => true,
                        ]);
                        DB::rollback();
                        $this->forgetCache();

                        return;
                    }
                }
            }

            // Determinar la lógica de validación basada en los valores mínimo y máximo
            if ($this->minimo_objetivo < $this->maximo_objetivo) {
                for ($i = 1; $i < $numEscalas; $i++) {
                    for ($j = 0; $j < $i; $j++) {
                        if ($this->array_escalas_objetivos[$i]['valor'] < $this->array_escalas_objetivos[$j]['valor']) {
                            $this->alert('error', 'Error de validación', [
                                'position' => 'center',
                                'timer' => 6000,
                                'toast' => false,
                                'text' => 'Cada posición debe ser mayor o igual que todas sus predecesoras.',
                                'showConfirmButton' => true,
                                'confirmButtonText' => 'Entendido',
                                'timerProgressBar' => true,
                            ]);
                            DB::rollback();
                            $this->forgetCache();

                            return;
                        }
                    }
                }
            } else {
                for ($i = 1; $i < $numEscalas; $i++) {
                    for ($j = 0; $j < $i; $j++) {
                        if ($this->array_escalas_objetivos[$i]['valor'] > $this->array_escalas_objetivos[$j]['valor']) {
                            $this->alert('error', 'Error de validación', [
                                'position' => 'center',
                                'timer' => 6000,
                                'toast' => false,
                                'text' => 'Cada posición debe ser menor o igual que todas sus predecesoras.',
                                'showConfirmButton' => true,
                                'confirmButtonText' => 'Entendido',
                                'timerProgressBar' => true,
                            ]);
                            DB::rollback();
                            $this->forgetCache();

                            return;
                        }
                    }
                }
            }

            // Guardar las escalas
            foreach ($this->array_escalas_objetivos as $key => $esc_obj) {
                EscalasObjetivosDesempeno::create([
                    'id_objetivo_desempeno' => $objetivo->id,
                    'condicion' => $esc_obj['condicional'],
                    'valor' => $esc_obj['valor'],
                    'parametro' => $esc_obj['parametro'],
                    'color' => $esc_obj['color'],
                ]);
            }

            $this->alert('success', 'Objetivo Creado', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'El objetivo ha sido creado con éxito.',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Entendido',
                'timerProgressBar' => true,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $this->forgetCache();
            dd($th);
            $this->alert('error', 'Error al crear Objetivo', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'Ha habido un error al crear el objetivo, por favor corrobore su información e intentelo de nuevo.',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Entendido',
                'timerProgressBar' => true,
            ]);
        }

        $this->resetInputsObjetivo();
        $this->resetInputsPeriodos();
        $this->resetInputsEscalas();
    }

    public function confirmarEnvioPapelera($objetivoId)
    {
        $this->dispatch('confirmarEnvioPapelera', ['objetivoId' => $objetivoId]);
    }

    public function enviarPapelera($id_obj)
    {
        // dump(1, $id_obj);
        $objetivo = ObjetivoEmpleado::find($id_obj);
        // dump(2, $objetivo);
        $objetivo->update([
            'papelera' => true,
        ]);

        $this->alert('success', 'Objetivo Desechado', [
            'position' => 'center',
            'timer' => 6000,
            'toast' => false,
            'text' => 'El objetivo ha sido enviado a la papelera.',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Entendido',
            'timerProgressBar' => true,
        ]);
    }

    public function crearUnidad()
    {
        $unidad = MetricasObjetivo::create([
            'definicion' => $this->nombre_unidad,
            'valor_minimo' => $this->minimo_unidad,
            'valor_maximo' => $this->maximo_unidad,
        ]);

        $this->unidades = MetricasObjetivo::getAll();

        $this->resetInputsUnidad();

        $this->alert('success', 'Unidad Creada', [
            'position' => 'center',
            'timer' => 6000,
            'toast' => false,
            'text' => 'Se ha creado la unidad con éxito.',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Entendido',
            'timerProgressBar' => true,
        ]);
    }

    public function editarUnidad()
    {
        $editar_unidad = $this->unidades->find($this->select_unidad);

        $this->nombre_edit_unidad = $editar_unidad->definicion;
        $this->minimo_edit_unidad = $editar_unidad->valor_minimo;
        $this->maximo_edit_unidad = $editar_unidad->valor_maximo;
    }

    public function updateUnidad()
    {
        $editar_unidad = $this->unidades->find($this->select_unidad);

        $editar_unidad->update([
            'definicion' => $this->nombre_edit_unidad,
            'valor_minimo' => $this->minimo_edit_unidad,
            'valor_maximo' => $this->maximo_edit_unidad,
        ]);

        $this->unidades = MetricasObjetivo::getAll();

        $this->updatedSelectUnidad();
        $this->resetInputsEditUnidad();

        $this->alert('success', 'Unidad Editada', [
            'position' => 'center',
            'timer' => 6000,
            'toast' => false,
            'text' => 'La unidad fue editada exitosamente.',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Entendido',
            'timerProgressBar' => true,
        ]);
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
}
