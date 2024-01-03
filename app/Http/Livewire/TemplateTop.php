<?php

namespace App\Http\Livewire;

use App\Models\TemplateAnalisisdeBrechas;
use Livewire\Component;

class TemplateTop extends Component
{
    public $registrosactivos = 0;

    public $limit_registros = 2;

    public function mount()
    {
        $this->registrosactivos = TemplateAnalisisdeBrechas::where('top', true)->count();
    }

    public function render()
    {
        $top_analisis = TemplateAnalisisdeBrechas::get();

        return view('livewire.template-top', compact('top_analisis'));
    }

    public function top($id)
    {
        if ($this->registrosactivos <= $this->limit_registros) {
            $templateTop = TemplateAnalisisdeBrechas::find($id);

            $estatus = $templateTop->top;

            $templateTop->update([
                'top' => ! $estatus,
            ]);
            $this->registrosactivos = TemplateAnalisisdeBrechas::where('top', true)->count();
        }

    }
}
