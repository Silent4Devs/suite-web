<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TemplateAnalisisdeBrechas;

class TemplateTop extends Component
{
    public $registrosactivos = 0;

    public $limit_registros = 8;

    protected $listeners = ['destroy'];

    public function mount()
    {
    }
    public function render()
    {
        $this->registrosactivos = TemplateAnalisisdeBrechas::where('top', true)->count();
        $top_analisis = TemplateAnalisisdeBrechas::get();
        return view('livewire.template-top', compact('top_analisis'));
    }

    public function top($id)
    {
        if($this->registrosactivos <= $this->limit_registros)
        {
            $templateTop = TemplateAnalisisdeBrechas::find($id);

            $estatus = $templateTop->top;

            $templateTop->update([
                'top' => !$estatus,
            ]);
            $this->registrosactivos = TemplateAnalisisdeBrechas::where('top', true)->count();
        }

    }

    public function destroy($id)
    {
        TemplateAnalisisdeBrechas::destroy($id);
    }


}
