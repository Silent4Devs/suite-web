<?php

namespace App\Http\Livewire\CierreContratos;

use App\Models\ContractManager\CierreContrato;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Cierrecomponent extends Component
{
    use WithPagination, LivewireAlert;

    public $contrato_id;

    public $cierre_id;

    public $aspectos;

    public $cumple;

    public $observaciones;

    public $show_contrato; // En formulario de edit se está en vista de consulta entonces es true

    public $view = 'create';

    public $search;

    public $sort = 'aspectos';

    public $direction = 'desc';

    public $pagination = 5;

    protected $listeners = [
        'triggerDeleteCierre' => 'confirmDelete',
    ];

    public function render()
    {
        $cierre_contratos = CierreContrato::where('contrato_id', $this->contrato_id)
            ->where(function ($query) {
                $query->where('aspectos', 'like', '%' . $this->search . '%')
                    ->orWhere('cumple', 'like', '%' . $this->search . '%')
                    ->orWhere('observaciones', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        $this->dispatchBrowserEvent('paginador-cierre-contrato');

        return view('livewire.cierre-contratos.cierrecomponent', [
            'cierrecontratos' => $cierre_contratos,
        ]);
    }

    public function mount($contrato_id, $show_contrato)
    {
        $this->contrato_id = $contrato_id;
        $this->show_contrato = $show_contrato;
        $this->cumple = true;
    }

    public function store()
    {
        $cumple = $this->cumple != null ? true : false;
        $cierrC = CierreContrato::create([
            'contrato_id' => $this->contrato_id,
            'aspectos' => $this->aspectos,
            'cumple' => $cumple,
            'observaciones' => $this->observaciones,
        ]);

        //$this->edit($post->id);
        $this->emit('recargar-cumplimiento');
        $this->dispatchBrowserEvent('contentChanged');
        $this->default();

        $this->alert('success', 'Registro añadido!');
    }

    public function edit($id)
    {
        $cierrC = CierreContrato::find($id);
        $this->cierre_id = $cierrC->id;
        $this->aspectos = $cierrC->aspectos;
        $this->cumple = $cierrC->cumple;
        $this->observaciones = $cierrC->observaciones;
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'edit';
    }

    public function update()
    {
        $this->validate([

            'aspectos' => 'required',
            //'observaciones' => 'required'
        ]);

        $cierrC = CierreContrato::find($this->cierre_id);
        $cumple = $this->cumple != null ? true : false;
        $cierrC->update([
            'contrato_id' => $this->contrato_id,
            'aspectos' => $this->aspectos,
            'cumple' => $cumple,
            'observaciones' => $this->observaciones,
        ]);
        $this->emit('recargar-cumplimiento');
        $this->default();
        //$this->dispatchBrowserEvent('contentChanged');
        $this->alert('success', 'Registro actualizado!');
    }

    public function confirmDelete($em_id)
    {
        $this->dispatchBrowserEvent('confirmDeleteCierreEvent', ['em_id' => $em_id]);
    }

    public function destroy($id)
    {
        CierreContrato::destroy($id);
        $this->emit('recargar-cumplimiento');
        $this->alert('success', 'Registro eliminado!');
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function default()
    {
        $this->aspectos = '';
        $this->cumple = true;
        $this->observaciones = '';
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'create';
    }
}
