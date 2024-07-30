<?php

namespace App\Livewire;

use App\Models\TBTemplateAnalisisRiesgoModel;
use Livewire\Component;

class TemplateTopAnalisisRiesgos extends Component
{
    public $templates;

    public $registrosactivos = 0;

    public $limit_registros = 8;

    protected $listeners = ['destroy'];

    public function top($id)
    {
        if ($this->registrosactivos <= $this->limit_registros) {
            $templateTop = TBTemplateAnalisisRiesgoModel::find($id);

            $estatus = $templateTop->top;

            $templateTop->update([
                'top' => ! $estatus,
            ]);
            $this->registrosactivos = TBTemplateAnalisisRiesgoModel::where('top', true)->count();
        }

    }

    public function destroy($id)
    {
        TBTemplateAnalisisRiesgoModel::destroy($id);
    }

    public function render()
    {
        $this->registrosactivos = TBTemplateAnalisisRiesgoModel::where('top', true)->count();
        $templates = TBTemplateAnalisisRiesgoModel::orderBy('id', 'asc')->get();
        foreach ($templates as $template) {
            $newDate = $template->created_at->format('Y-m-d');
            $template->fecha = $newDate;
        }
        $this->templates = $templates;

        return view('livewire.template-top-analisis-riesgos');
    }
}
