<?php

namespace App\Livewire\CatalogueTraining;

use App\Models\TBCatalogueTrainingModel;
use App\Models\TBTypeCatalogueTrainingModel;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TypeCatalogueTraining extends Component
{
    #[Validate('required')]
    public $name = '';

    public $registers;

    public $status = true;

    public $editRegister;

    public $deleteRegister;

    public function registersRestore()
    {
        // dd("click");
        TBTypeCatalogueTrainingModel::onlyTrashed()->restore();
    }

    public function clearInput()
    {
        $this->reset('name', 'status', 'editRegister');
    }

    public function delete()
    {
        if (TBCatalogueTrainingModel::where('type_id', $this->deleteRegister->id)->exists()) {
            $this->dispatch('useRegister');
        } else {
            $this->dispatch('registerDelete');
            $this->deleteRegister->delete();
        }
    }

    public function deleteMessage($id)
    {
        $register = TBTypeCatalogueTrainingModel::findOrFail($id);
        $this->deleteRegister = $register;
        $this->dispatch('deleteMessage');
    }

    public function edit($id)
    {
        $this->status = false;
        $register = TBTypeCatalogueTrainingModel::findOrFail($id);
        $this->name = $register->name;
        $this->editRegister = $register;
    }

    public function update()
    {
        $this->validate();
        $this->editRegister->update([
            'name' => $this->name,
        ]);
        $this->clearInput();
        $this->dispatch('edited');
    }

    public function save()
    {
        $this->validate();
        TBTypeCatalogueTrainingModel::create([
            'name' => $this->name,
            'default' => false,
        ]);
        $this->clearInput();
        $this->dispatch('saved');
    }

    public function form()
    {
        $this->status ? $this->save() : $this->update();
    }

    public function render()
    {
        $registers = TBTypeCatalogueTrainingModel::orderBy('id')->get();
        foreach ($registers as $register) {
            $date = Carbon::parse($register->created_at)->format('d-m-Y');
            $register->date = $date;
        }
        $this->registers = $registers;

        return view('livewire.catalogue-training.type-catalogue-training');
    }
}
