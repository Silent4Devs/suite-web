<?php

namespace App\Livewire\Training;

use App\Livewire\Forms\CatalogueTraining\CatalogueTrainingForm;
use App\Livewire\Forms\Certificates\TrainingForm;
use App\Models\TBEvidenceTrainingModel;
use App\Models\TBTypeCatalogueTrainingModel;
use App\Models\TBUserTrainingModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Training extends Component
{
    use WithFileUploads;
    public TrainingForm $form;
    public CatalogueTrainingForm $modalForm;
    public $types;
    public Collection $names;
    public $empleado_id;
    public $registers;
    public $status = 'create';
    public $id;

    public function downloadEvidencie($id)
    {
        $evidenceRegister = TBEvidenceTrainingModel::findOrFail($id);
        $filePath = $evidenceRegister->ubication . '/'. $evidenceRegister->name;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }
    }

    public function edit()
    {
        $succes = $this->form->update($this->id);
        if($succes){
            $this->dispatch('edited');
            $this->status = 'create';
        }else {
            $this->dispatch('error');
        }
    }

    public function getRegister($id)
    {
        $register = TBUserTrainingModel::findOrFail($id);
        $this->id = $id;
        $this->form->type_id = $register->type_id;
        $this->getCatalogueName();
        $this->status = 'edit';
        $register->type_id = strval($register->type_id);
        $register->startDate = $register->start_date;
        $register->endDate = $register->end_date;
        $register->validityStatus = $register->validityStatus ? 'Vigente':'Vencido';
        $this->form->fillData($register->toArray());
    }

    public function saveModal()
    {
        $succes = $this->modalForm->userStore();

    }

    public function save()
    {
        $this->form->empleado_id = $this->empleado_id;
        $succes = $this->form->store();
        if($succes){
            $this->dispatch('saved');
        }else {
            $this->dispatch('error');
        }
    }

    public function verifyStatus()
    {
        $date = Carbon::now();
        if($date >=$this->form->validity){
            $this->form->validityStatus = "Vencido";
        }else {
            $this->form->validityStatus = "Vigente";
        }
    }

    public function chanceChecked()
    {
        $this->form->isChecked = !$this->form->isChecked;
        if($this->form->isChecked === false){
            $this->form->validity = "";
            $this->form->validityStatus = "";
        }
    }

    public function getCatalogueName()
    {
        $type_id = intval($this->form->type_id);
        foreach($this->types as $type){
            if($type->id === $type_id){
                $this->names = $type->catalogue;
                break;
            }
        }
    }

    public function mount($id)
    {
        $this->names = collect();
        $this->empleado_id = $id;
    }

    public function render()
    {
        $types = TBTypeCatalogueTrainingModel::orderBy('name','asc')->get();
        $registers = TBUserTrainingModel::where('empleado_id',$this->empleado_id)->orderBy('id')->get();
        $this->types = $types;
        foreach($registers as $register){
            $register->start_date = Carbon::parse($register->start_date)->format('d-m-Y');
            $register->end_date = Carbon::parse($register->end_date)->format('d-m-Y');
            if($register->validity){
                $register->validity = Carbon::parse($register->validity)->format('d-m-Y');
            }
        }
        $this->registers = $registers;

        return view('livewire.training.training');
    }
}
