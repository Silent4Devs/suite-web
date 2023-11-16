<?php

namespace App\Livewire;

use App\Models\PanelOrganizacion;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class OrganizacionComponent extends Component
{
    use LivewireAlert;

    public $panel;

    public $empresa_id;

    public $direccion_id;

    public $telefono_id;

    public $correo_id;

    public $pagina_web_id;

    public $puesto_id;

    public $giro_id;

    public $servicios_id;

    public $mision_id;

    public $vision_id;

    public $valores_id;

    public $team_id_id;

    public $antecedentes_id;

    public $logotipo_id;

    public $razon_social_id;

    public $rfc_id;

    public $representante_legal_id;

    public $fecha_constitucion_id;

    public $num_empleados_id;

    public $tamano_id;

    public $schedule_id;

    public $linkedln_id;

    public $facebook_id;

    public $youtube_id;

    public $twitter_id;

    public function mount()
    {

    }

    public function render()
    {
        $this->panel = PanelOrganizacion::first();
        $this->empresa_id = $this->panel->empresa;
        $this->direccion_id = $this->panel->direccion;
        $this->telefono_id = $this->panel->telefono;
        $this->correo_id = $this->panel->correo;
        $this->pagina_web_id = $this->panel->pagina_web;
        $this->giro_id = $this->panel->giro;
        $this->servicios_id = $this->panel->servicios;
        $this->mision_id = $this->panel->mision;
        $this->vision_id = $this->panel->vision;
        $this->valores_id = $this->panel->valores;
        $this->team_id_id = $this->panel->team_id;
        $this->antecedentes_id = $this->panel->antecedentes;
        $this->logotipo_id = $this->panel->logotipo;
        $this->razon_social_id = $this->panel->razon_social;
        $this->rfc_id = $this->panel->rfc;
        $this->representante_legal_id = $this->panel->representante_legal;
        $this->fecha_constitucion_id = $this->panel->fecha_constitucion;
        $this->num_empleados_id = $this->panel->num_empleados;
        $this->tamano_id = $this->panel->tamano;
        $this->schedule_id = $this->panel->schedule;
        $this->linkedln_id = $this->panel->linkedln;
        $this->facebook_id = $this->panel->facebook;
        $this->youtube_id = $this->panel->youtube;
        $this->twitter_id = $this->panel->twitter;

        return view('livewire.organizacion-component');
    }

    public function updatedEmpresaId($value)
    {
        $this->empresa_id = $value;
        $this->panel->empresa = $this->empresa_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedDireccionId($value)
    {
        $this->direccion_id = $value;
        $this->panel->direccion = $this->direccion_id;
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

    public function updatedCorreoId($value)
    {
        $this->correo_id = $value;
        $this->panel->correo = $this->correo_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedPaginaWebId($value)
    {
        // dd($value);
        $this->pagina_web_id = $value;
        $this->panel->pagina_web = $this->pagina_web_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedGiroId($value)
    {
        $this->giro_id = $value;
        $this->panel->giro = $this->giro_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedServiciosId($value)
    {
        $this->servicios_id = $value;
        $this->panel->servicios = $this->servicios_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedMisionId($value)
    {
        $this->mision_id = $value;
        $this->panel->mision = $this->mision_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedVisionId($value)
    {
        $this->vision_id = $value;
        $this->panel->vision = $this->vision_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedValoresId($value)
    {
        $this->valores_id = $value;
        $this->panel->valores = $this->valores_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedTeamId($value)
    {
        $this->team_id_id = $value;
        $this->panel->team_id = $this->team_id_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedAntecedentesId($value)
    {
        $this->antecedentes_id = $value;
        $this->panel->antecedentes = $this->antecedentes_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedLogotipoId($value)
    {
        $this->logotipo_id = $value;
        $this->panel->logotipo = $this->logotipo_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedRazonsocialId($value)
    {
        $this->razon_social_id = $value;
        $this->panel->razon_social = $this->razon_social_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedRfcId($value)
    {
        $this->rfc_id = $value;
        $this->panel->rfc = $this->rfc_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedRepresentantelegalId($value)
    {
        $this->representante_legal_id = $value;
        $this->panel->representante_legal = $this->representante_legal_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedFechaconstitucionId($value)
    {
        $this->fecha_constitucion_id = $value;
        $this->panel->fecha_constitucion = $this->fecha_constitucion_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedNumEmpleadosId($value)
    {
        $this->num_empleados_id = $value;
        $this->panel->num_empleados = $this->num_empleados_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedTamanoId($value)
    {
        $this->tamano_id = $value;
        $this->panel->tamano = $this->tamano_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedScheduleId($value)
    {
        $this->schedule_id = $value;
        $this->panel->schedule = $this->schedule_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedLinkedlnId($value)
    {
        $this->linkedln_id = $value;
        $this->panel->linkedln = $this->linkedln_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedFacebookId($value)
    {
        $this->facebook_id = $value;
        $this->panel->facebook = $this->facebook_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedYoutubeId($value)
    {
        $this->youtube_id = $value;
        $this->panel->youtube = $this->youtube_id;
        $this->panel->save();
        $this->callAlert('success', 'La información se actualizo correctamente', false);
    }

    public function updatedTwitterId($value)
    {
        $this->twitter_id = $value;
        $this->panel->twitter = $this->twitter_id;
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
