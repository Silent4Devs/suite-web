<?php

namespace App\Livewire\CatalogueTraining;

use App\Models\TBCatalogueTrainingModel;
use App\Models\TBTypeCatalogueTrainingModel;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class TypeCatalogueTraining extends Component
{
    use WithPagination;

    #[Validate('required')]
    public $name = '';

    // public $registers;

    public $status = true;

    public $editRegister;

    public $deleteRegister;

    public $perPage = 5;

    public $search = '';

    public function updatingPerPage()
    {
        $this->resetPage();
    }

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
        $registers = TBTypeCatalogueTrainingModel::query()
            ->when($this->search, function ($query) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($this->search).'%']);
            })
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);

        foreach ($registers as $register) {
            $date = Carbon::parse($register->created_at)->format('d-m-Y');
            $register->date = $date;
        }

        // $registers = $registers->fastPaginate($this->perPage);
        // $registers = $registers;

        return view('livewire.catalogue-training.type-catalogue-training', compact('registers'));
    }
}
