<?php

namespace App\Http\Livewire;

use App\Mail\EvaluacionesDesempenoEliminacionEvaluador;
use App\Models\Activo;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\EvaluacionDesempeno;
use App\Models\EvaluadoresEvaluacionCompetenciasDesempeno;
use App\Models\EvaluadoresEvaluacionObjetivosDesempeno;
use App\Models\ListaInformativa;
use App\Models\Recurso;
use App\Models\RevisionDocumento;
use App\Models\User;
use App\Traits\EmpleadoFunciones;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class BajaEmpleadoComponent extends Component
{
    use EmpleadoFunciones, ObtenerOrganizacion;

    public $empleado;

    public $empleados;

    public $fechaBaja;

    public $razonBaja;

    public $nuevoSupervisor;

    public $comites;

    public $documentosQueDeboAprobar;

    public $documentosQueMeDebenAprobar;

    public $misActivos;

    public $misCapacitaciones;

    protected $rules = [
        'fechaBaja' => 'required|date',
        'razonBaja' => 'required|string|max:20000',
    ];

    protected $messages = [
        'fechaBaja.required' => 'La fecha de baja es requerida',
        'fechaBaja.date' => 'La fecha de baja debe ser una fecha válida',
        'razonBaja.required' => 'La razón de baja es requerida',
        'razonBaja.string' => 'La razón de baja debe ser un texto',
        'razonBaja.max' => 'La razón de baja debe tener como máximo 20000 caracteres',
    ];

    public function hydrate()
    {
        $this->emit('select2');
    }

    //mount
    public function mount($empleado)
    {
        $this->empleado = $empleado;
        $this->empleados = $this->obtenerEmpleados();
        $this->documentosQueDeboAprobar = $this->obtenerDocumentosQueDeboAprobar();
        $this->documentosQueMeDebenAprobar = $this->obtenerDocumentosQueMeDebenAprobar();
        $this->misActivos = $this->obtenerMisActivos();
        $this->misCapacitaciones = $this->obtenerCapacitaciones();
    }

    public function render()
    {
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo = $organizacion_actual->logo;
        $empresa = $organizacion_actual->empresa;

        return view('livewire.baja-empleado-component', compact('logo', 'empresa'));
    }

    public function obtenerEmpleados()
    {
        $empleados = Empleado::alta()->where('id', '!=', $this->empleado->id)->select('id', 'name')->orderBy('name')->get();

        return $empleados;
    }

    public function obtenerComites()
    {
        $comites = $this->empleado->comiteSeguridad;

        return $comites;
    }

    public function obtenerDocumentosQueDeboAprobar()
    {
        $revisiones = RevisionDocumento::getAllWithDocumento();

        return $revisiones;
    }

    public function obtenerDocumentosQueMeDebenAprobar()
    {
        $mis_documentos = Documento::getWithMacroproceso($this->empleado->id);

        return $mis_documentos;
    }

    public function obtenerMisActivos()
    {
        $activos = Activo::select('*')->where('id_responsable', '=', $this->empleado->id)->get();

        return $activos;
    }

    public function obtenerCapacitaciones()
    {
        $empleado = $this->empleado->id;
        $cacheKeyRecursos = 'Recursos:recursos_' . User::getCurrentUser()->id;
        $recursos = Cache::remember($cacheKeyRecursos, 3600 * 8, function () use ($empleado) {
            return Recurso::whereHas('empleados', function ($query) use ($empleado) {
                $query->where('empleados.id', $empleado);
            })->get();
        });

        return $recursos;
    }

    public function cambiarSupervisor()
    {
        $empleadosACargo = $this->empleado->children;
        $empleadosACargo->each(function ($empleado) {
            // $empleado->update([
            //     'supervisor_id' => $this->nuevoSupervisor
            // ]);
        });
        $this->emit('select2');
    }

    public function darDeBaja()
    {
        $this->empleadoEvaluador($this->empleado->id);

        $this->validate($this->rules, $this->messages);

        $this->empleado->update([
            'estatus' => Empleado::BAJA,
            'fecha_baja' => $this->fechaBaja,
            'razon_baja' => $this->razonBaja,
        ]);

        $user = User::where('email', trim(preg_replace('/\s/u', ' ', $this->empleado->email)))->first();
        if ($user) {
            $user->delete();
        }

        $this->emit('select2');
        $this->emit('baja', $this->empleado);
    }

    public function empleadoEvaluador($id_empleado)
    {
        $empleado = Empleado::getAllDataColumns()->find($id_empleado);

        $informados = ListaInformativa::with('participantes.empleado', 'usuarios.usuario')->where('modelo', '=', 'EvaluacionDesempeno')->first();

        if (isset($informados->participantes[0]) || isset($informados->usuarios[0])) {

            if (isset($informados->participantes[0])) {
                foreach ($informados->participantes as $participante) {
                    $correodestinatario[] = $participante->empleado->email;
                }
            }

            if (isset($informados->usuarios[0])) {
                foreach ($informados->usuarios as $usuario) {
                    $correodestinatario[] = $usuario->usuario->email;
                }
            }
        }

        $evaluadorDeCompetencias = EvaluadoresEvaluacionCompetenciasDesempeno::with('evaluacion', 'periodo')
            ->where('evaluador_desempeno_id', $id_empleado)
            ->get();

        $evaluadorDeObjetivos = EvaluadoresEvaluacionObjetivosDesempeno::with('evaluacion', 'periodo')
            ->where('evaluador_desempeno_id', $id_empleado)
            ->get();

        $allEvaluaciones = collect();

        if ($evaluadorDeCompetencias->isNotEmpty()) {
            foreach ($evaluadorDeCompetencias as $evcompetencia) {
                if (!$evcompetencia->periodo->finalizado) {
                    $allEvaluaciones->push($evcompetencia->evaluacion->id);
                    $evcompetencia->delete();
                }
            }
        }

        if ($evaluadorDeObjetivos->isNotEmpty()) {
            foreach ($evaluadorDeObjetivos as $evobjetivo) {
                if (!$evobjetivo->periodo->finalizado) {
                    $allEvaluaciones->push($evobjetivo->evaluacion->id);
                    $evobjetivo->delete();
                }
            }
        }

        // Get unique evaluacion values
        $uniqueEvaluaciones = $allEvaluaciones->unique();

        // Convert to array if needed
        $uniqueEvaluacionesArray = $uniqueEvaluaciones->values()->all();

        if (!empty($uniqueEvaluacionesArray)) {
            foreach ($uniqueEvaluacionesArray as $key_evaluacion => $id_evaluacion) {
                $evaluacion = EvaluacionDesempeno::find($id_evaluacion);
                $emailEvaluador = new EvaluacionesDesempenoEliminacionEvaluador($evaluacion->nombre, $empleado->name);
                Mail::to($correodestinatario)->queue($emailEvaluador);
            }
        }
    }
}
