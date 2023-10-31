<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Activo;
use App\Models\Recurso;
use Livewire\Component;
use App\Models\Empleado;
use App\Models\Documento;
use App\Models\RevisionDocumento;
use App\Traits\EmpleadoFunciones;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Support\Facades\Cache;

class BajaEmpleadoComponent extends Component
{
    use ObtenerOrganizacion, EmpleadoFunciones;

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
        $revisiones = RevisionDocumento::getAllWithDocumento()->where('empleado_id', $this->empleado->id)->where('archivado', RevisionDocumento::NO_ARCHIVADO);

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
                $query->where('empleados.id', $empleado->id);
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
}
