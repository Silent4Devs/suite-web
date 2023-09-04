<?php

namespace App\Http\Livewire;

use App\Models\AmenazasEntendimientoOrganizacion;
use App\Models\AnalisisDeRiesgo;
use App\Models\DebilidadesEntendimientoOrganizacion;
use App\Models\FortalezasEntendimientoOrganizacion;
use App\Models\MatrizRiesgo;
use App\Models\OportunidadesEntendimientoOrganizacion;
use Livewire\Component;

class RiesgosFoda extends Component
{
    public $analisisSeleccionado;

    public $riesgosPorAnalisis;

    public $modelId;

    public $modelType;

    public $riesgosSeleccionados;

    public $globalModel;

    protected $listeners = ['modalRiesgoFoda'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function updatedAnalisisSeleccionado()
    {
        if ($this->analisisSeleccionado == '') {
            $this->default();
        } else {
            $this->riesgosPorAnalisis = MatrizRiesgo::getAll()->where('id_analisis', $this->analisisSeleccionado);
        }
        // dd($this->riesgosPorAnalisis);
    }

    public function modalRiesgoFoda($id, $type)
    {
        $this->modelId = $id;
        $this->modelType = $type;
        if ($this->modelType == 'fortaleza') {
            $this->globalModel = FortalezasEntendimientoOrganizacion::find($id);
        }
        if ($this->modelType == 'oportunidad') {
            $this->globalModel = OportunidadesEntendimientoOrganizacion::find($id);
        }
        if ($this->modelType == 'debilidad') {
            $this->globalModel = DebilidadesEntendimientoOrganizacion::find($id);
        }
        if ($this->modelType == 'amenaza') {
            $this->globalModel = AmenazasEntendimientoOrganizacion::find($id);
        }
    }

    public function save()
    {
        // dd($this->riesgosSeleccionados);
        if ($this->modelType == 'fortaleza') {
            $this->globalModel = FortalezasEntendimientoOrganizacion::find($this->modelId);
            $this->globalModel->riesgos()->sync($this->riesgosSeleccionados);
        }
        if ($this->modelType == 'oportunidad') {
            $this->globalModel = OportunidadesEntendimientoOrganizacion::find($this->modelId);
            $this->globalModel->riesgos()->sync($this->riesgosSeleccionados);
        }
        if ($this->modelType == 'debilidad') {
            $this->globalModel = DebilidadesEntendimientoOrganizacion::find($this->modelId);
            $this->globalModel->riesgos()->sync($this->riesgosSeleccionados);
        }
        if ($this->modelType == 'amenaza') {
            $this->globalModel = AmenazasEntendimientoOrganizacion::find($this->modelId);
            $this->globalModel->riesgos()->sync($this->riesgosSeleccionados);
        }
        $this->default();
        // $this->emit('cerrarModal');
    }

    public function default()
    {
        $this->riesgosPorAnalisis = null;
        $this->riesgosSeleccionados = null;
        $this->analisisSeleccionado = null;
    }

    public function render()
    {
        $analisis = AnalisisDeRiesgo::where('tipo', 'Seguridad de la información')->get();

        // dd($analisis);
        return view('livewire.riesgos-foda', compact('analisis'));
    }
}
