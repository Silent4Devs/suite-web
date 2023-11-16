<?php

namespace App\Livewire;

use App\Models\Empleado;
use App\Models\MiembrosComiteSeguridad;
use Carbon\Carbon;
use Livewire\Component;

class CreateMiembrosComiteSeguridad extends Component
{
    public $nombre_rol;

    public $fecha_vigor;

    public $colaborador;

    public $responsabilidades;

    public $id_comite;

    public $miembroID;

    public $id_interesado;

    public $parteInteresadaIdEN;

    public $view = 'create';

    public $normasModel = [];

    protected $listeners = ['editarParteInteresada' => 'edit', 'eliminarParteInteresada' => 'destroy', 'agregarNormas'];

    public function hydrate()
    {
        $this->dispatch('select2');
    }

    public function validarMiembro()
    {
        $this->validate([
            'nombre_rol' => 'required|max:1250',
            'colaborador' => 'required|int',
            'fecha_vigor' => 'required|date',
            'responsabilidades' => 'required|max:1250',
        ]);
    }

    public function create()
    {
        $this->default();
        $this->dispatch('abrir-modal');
    }

    public function save()
    {
        $this->validarMiembro();
        $model = MiembrosComiteSeguridad::create([
            'nombrerol' => $this->nombre_rol,
            'id_asignada' => $this->colaborador,
            'fechavigor' => $this->fecha_vigor,
            'responsabilidades' => $this->responsabilidades,
            'comite_id' => $this->id_comite,
        ]);

        $this->reset('nombre_rol', 'colaborador', 'fecha_vigor', 'responsabilidades');
        $this->dispatch('render');
        $this->dispatch('cerrar-modal', editar: false);
    }

    public function edit($id)
    {
        $this->view = 'edit';
        $model = MiembrosComiteSeguridad::find($id);
        // dd($model);
        $this->nombre_rol = $model->nombrerol;
        $this->fecha_vigor = Carbon::parse($model->fechavigor)->format('Y-m-d');
        $this->colaborador = $model->id_asignada;
        $this->responsabilidades = $model->responsabilidades;
        $this->id_comite = $model->comite_id;
        $this->miembroID = $model->id;
        $this->dispatch('abrir-modal');
        $this->dispatch('editar-modal', Responsabilidades: $model->responsabilidades);
        $this->dispatch('cargar-puesto', Id: $id);
    }

    public function default()
    {
        $this->nombre_rol = '';
        $this->fecha_vigor = '';
        $this->colaborador = '';
        $this->responsabilidades = '';

        $this->view = 'create';
    }

    public function update()
    {
        $this->validarMiembro();
        $model = MiembrosComiteSeguridad::find($this->miembroID);
        $model->update([
            'nombrerol' => $this->nombre_rol,
            'id_asignada' => $this->colaborador,
            'fechavigor' => $this->fecha_vigor,
            'responsabilidades' => $this->responsabilidades,
            'comite_id' => $this->id_comite,
        ]);
        $this->dispatch('cerrar-modal', editar: true);
        $this->default();
        $this->dispatch('render');
    }

    public function destroy($id)
    {
        $model = MiembrosComiteSeguridad::find($id);
        $model->delete();
        $this->dispatch('render');
    }

    public function render()
    {
        $empleados = Empleado::getAltaEmpleadosWithArea();

        return view('livewire.create-miembros-comite-seguridad', compact('empleados'));
    }
}
