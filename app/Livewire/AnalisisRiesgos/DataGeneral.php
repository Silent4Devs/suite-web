<?php

namespace App\Livewire\AnalisisRiesgos;

use App\Models\Norma;
use App\Models\TBTemplateAnalisisRiesgoModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DataGeneral extends Component
{
    public $template_id;

    private $template;

    public $edit = false;

    public $name;

    public $norma = 'ISO 27001';

    public $norma_id;

    public $description;

    protected $listeners = [
        'renderReloadDataGeneral' => 'mount',
        'renderSaveDataGeneral' => 'update',
    ];

    public function mount($template_id)
    {
        $this->template_id = $template_id;
    }

    public function update()
    {
        $template = TBTemplateAnalisisRiesgoModel::findOrFail($this->template_id);
        DB::beginTransaction();
        try {
            $template->update([
                'nombre' => $this->name,
                'norma_id' => $this->norma_id,
                'descripcion' => $this->description,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
        }
    }

    public function render()
    {
        $normas = Norma::get()->first();
        $this->norma_id = $normas->id;

        $template = TBTemplateAnalisisRiesgoModel::findOrFail($this->template_id);

        $this->template = $template;

        if ($template->nombre === 'Sin nombre' && $template->descripcion === 'Sin descripcion') {
            $this->name = '';
            $this->description = '';
        } else {
            $this->name = $template->nombre;
            $this->description = $template->descripcion;
        }

        return view('livewire.analisis-riesgos.data-general');
    }
}
