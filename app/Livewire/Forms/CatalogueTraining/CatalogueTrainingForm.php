<?php

namespace App\Livewire\Forms\CatalogueTraining;

use App\Models\TBCatalogueTrainingModel;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CatalogueTrainingForm extends Form
{
    public $name;
    public $issuing_company;
    public $mark;
    public $manufacturer;
    public $norma;
    public $type_id;

    public function update($id)
    {
        $existing = TBCatalogueTrainingModel::where('name', $this->name)->where('type_id', $this->type_id)->exists();
        $register = TBCatalogueTrainingModel::where('name', $this->name)->where('type_id', $this->type_id)->first();

        if($existing && $register && $register->id !== $id){
            return false;
        }else {
            $updateRegister = TBCatalogueTrainingModel::findOrFail($id);
            $updateRegister->update([
                'name' => $this->name,
                'issuing_company' => $this->issuing_company,
                'mark' => $this->mark,
                'manufacturer' => $this->manufacturer,
                'norma' => $this->norma,
                'type_id' => $this->type_id,
            ]);
            $this->reset();
            return true;
        }
    }
    public function fillData(array $data)
    {
        $this->fill($data);
    }

    public function store()
    {
        $existing = TBCatalogueTrainingModel::where('name', $this->name)->where('type_id', $this->type_id)->exists();
            if($existing){
                return false;
            }else {
                TBCatalogueTrainingModel::create([
                    'name' => $this->name,
                    'issuing_company' => $this->issuing_company,
                    'mark' => $this->mark,
                    'manufacturer' => $this->manufacturer,
                    'norma' => $this->norma,
                    'type_id' => $this->type_id,
                ]);
                $this->reset();
                return true;
            }


    }

    // public function verify($status)
    // {
    //     if($status === 'create'){
    //         $existing = TBCatalogueTrainingModel::where('name', $this->name)->where('type_id', $this->type_id)->exists();
    //         if($existing){
    //             return false;
    //         }else {
    //            return $this->store();
    //         }
    //     }else {

    //     }
    // }
}
