<?php

namespace App\Livewire;

use App\Models\PanelInicioRule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PanelinicioComponent extends Component
{
    use LivewireAlert;

    public $panel;

    public $id_registro;

    public $nombre_id;

    public $nempleado_id;

    public $area_id;

    public $jefe_id;

    public $puesto_id;

    public $perfil_id;

    public $fechaingreso_id;

    public $genero_id;

    public $estatusemp_id;

    public $correo_id;

    public $telefono_id;

    public $sede_id;

    public $dire_id;

    public $cumpleanos_id;

    public function mount()
    {

    }

    public function render()
    {
        $this->panel = PanelInicioRule::get()->first();
        $this->nombre_id = $this->panel->nombre;
        $this->nempleado_id = $this->panel->n_empleado;
        $this->area_id = $this->panel->area;
        $this->jefe_id = $this->panel->jefe_inmediato;
        $this->puesto_id = $this->panel->puesto;
        $this->perfil_id = $this->panel->perfil;
        $this->fechaingreso_id = $this->panel->fecha_ingreso;
        $this->genero_id = $this->panel->genero;
        $this->estatusemp_id = $this->panel->estatus;
        $this->correo_id = $this->panel->email;
        $this->telefono_id = $this->panel->telefono;
        $this->sede_id = $this->panel->sede;
        $this->dire_id = $this->panel->direccion;
        $this->cumpleanos_id = $this->panel->cumpleaños;

        return view('livewire.panelinicio-component');
    }

    public function updatedNombreId($value)
    {
        $this->nombre_id = $value;
        $this->panel->nombre = $this->nombre_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedNempleadoId($value)
    {
        $this->nempleado_id = $value;
        $this->panel->n_empleado = $this->nempleado_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedAreaId($value)
    {
        $this->area_id = $value;
        $this->panel->area = $this->area_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedJefeId($value)
    {
        $this->jefe_id = $value;
        $this->panel->jefe_inmediato = $this->jefe_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedPuestoId($value)
    {
        $this->puesto_id = $value;
        $this->panel->puesto = $this->puesto_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedPerfilId($value)
    {
        $this->perfil_id = $value;
        $this->panel->perfil = $this->perfil_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedFechaingresoId($value)
    {
        $this->fechaingreso_id = $value;
        $this->panel->fecha_ingreso = $this->fechaingreso_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedGeneroId($value)
    {
        $this->genero_id = $value;
        $this->panel->genero = $this->genero_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedEstatusempId($value)
    {
        $this->estatusemp_id = $value;
        $this->panel->estatus = $this->estatusemp_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedCorreoId($value)
    {
        $this->correo_id = $value;
        $this->panel->email = $this->correo_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedTelefonoId($value)
    {
        $this->telefono_id = $value;
        $this->panel->telefono = $this->telefono_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedSedeId($value)
    {
        $this->sede_id = $value;
        $this->panel->sede = $this->sede_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedDireId($value)
    {
        $this->dire_id = $value;
        $this->panel->direccion = $this->dire_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedCumpleanosId($value)
    {
        $this->cumpleanos_id = $value;
        $this->panel->cumpleaños = $this->cumpleanos_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function callAlert($tipo, $mensaje, $bool, $test = '')
    {
        $this->alert($tipo, $mensaje, [
            'position' => 'top-end',
            'timer' => 2500,
            'toast' => true,
            'text' => $test,
            'confirmButtonText' => 'Entendido',
            'cancelButtonText' => '',
            'showCancelButton' => false,
            'showConfirmButton' => $bool,
        ]);
    }
}
