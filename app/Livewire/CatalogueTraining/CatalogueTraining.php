<?php

namespace App\Livewire\CatalogueTraining;

use App\Livewire\Forms\CatalogueTraining\CatalogueTrainingForm;
use App\Models\TBCatalogueTrainingModel;
use App\Models\TBTypeCatalogueTrainingModel;
use Livewire\Component;

class CatalogueTraining extends Component
{
    public CatalogueTrainingForm $form;

    public $registers;

    public $typesCatalogue;

    public $status = 'create';

    public $id;

    public function edit()
    {
        $this->id;
        $succes = $this->form->update($this->id);
        if ($succes) {
            $this->dispatch('edited');
            $this->status = 'create';
        } else {
            $this->dispatch('nameValidation');
        }
    }

    public function getRegister($id)
    {
        $this->status = 'edit';
        $this->id = $id;
        $register = TBCatalogueTrainingModel::findOrFail($id);
        $register->type_id = $register->category->id;
        $this->form->fillData($register->toArray());
    }

    public function save()
    {
        $succes = $this->form->store();
        if ($succes) {
            $this->dispatch('saved');
        } else {
            $this->dispatch('nameValidation');
        }
    }

    public function render()
    {
        $registers = TBCatalogueTrainingModel::where('status', 'approved')->orderBy('id')->get();
        $typesCatalogue = TBTypeCatalogueTrainingModel::orderBy('name')->get();

        $this->registers = $registers;
        $this->typesCatalogue = $typesCatalogue;

        return view('livewire.catalogue-training.catalogue-training');
    }
}
