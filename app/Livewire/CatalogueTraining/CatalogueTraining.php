<?php

namespace App\Livewire\CatalogueTraining;

use App\Livewire\Forms\CatalogueTraining\CatalogueTrainingForm;
use App\Models\TBCatalogueTrainingModel;
use App\Models\TBTypeCatalogueTrainingModel;
use App\Models\TBUserTrainingModel;
use Livewire\Component;
use Livewire\WithPagination;

class CatalogueTraining extends Component
{
    use WithPagination;

    public CatalogueTrainingForm $form;

    // public $registers;

    public $typesCatalogue;

    public $status = 'create';

    public $id;

    public $perPage = 5;

    public $search = '';

    public $deleteRegister;

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function delete()
    {
        if (TBUserTrainingModel::where('name_id', $this->deleteRegister->id)->exists()) {

            $this->dispatch('useRegister');
        } else {
            $this->dispatch('registerDelete');
            $this->deleteRegister->delete();
        }
    }

    public function deleteMessage($id)
    {
        $register = TBCatalogueTrainingModel::findOrFail($id);
        $this->deleteRegister = $register;
        $this->dispatch('deleteMessage');
    }

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
        $registers = TBCatalogueTrainingModel::query()->
        where('status', 'approved')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($this->search).'%'])
                        ->orWhereRaw('LOWER(issuing_company) LIKE ?', ['%'.strtolower($this->search).'%'])
                        ->orWhereRaw('LOWER(mark) LIKE ?', ['%'.strtolower($this->search).'%'])
                        ->orWhereRaw('LOWER(manufacturer) LIKE ?', ['%'.strtolower($this->search).'%'])
                        ->orWhereRaw('LOWER(norma) LIKE ?', ['%'.strtolower($this->search).'%'])
                        ->orWhereRaw('LOWER(status) LIKE ?', ['%'.strtolower($this->search).'%'])
                        ->orWhereHas('category', function ($query) {
                            $query->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($this->search).'%']);
                        });

                });
            })
            ->orderBy('id')
            ->paginate($this->perPage);
        $typesCatalogue = TBTypeCatalogueTrainingModel::orderBy('name')->get();

        $this->typesCatalogue = $typesCatalogue;

        return view('livewire.catalogue-training.catalogue-training', compact('registers'));
    }
}
