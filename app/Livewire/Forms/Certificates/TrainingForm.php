<?php

namespace App\Livewire\Forms\Certificates;

use App\Models\Empleado;
use App\Models\TBEvidenceTrainingModel;
use App\Models\TBUserTrainingModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Form;

class TrainingForm extends Form
{
    public $type_id;

    public $name_id;

    public $startDate;

    public $endDate;

    public $empleado_id;

    // type certification
    public $credential_id;

    public $credential_url;

    public $validity;

    public $validityStatus;

    public $isChecked = false;

    //Document
    public $document;

    public function verifyDocument(&$document_id)
    {
        if ($this->document) {
            $empleado = Empleado::findOrFail($this->empleado_id);
            $uuid = (string) Str::uuid();
            $folder = 'public/training/certificates';
            // get get equivalent special character from text
            $name = iconv('UTF-8', 'ASCII//TRANSLIT', $empleado->name);
            // Remove special characters from text
            $name = preg_replace('/[^A-Za-z0-9 ]/', '', $name);
            // Remove space between characters from text
            $name = str_replace(' ', '', $name);
            if (! Storage::exists($folder)) {
                Storage::makeDirectory($folder);
            }
            $fileName = $name.'-'.$uuid.'.'.$this->document->getClientOriginalExtension();
            $this->document->storeAs($folder, $fileName);

            $documentCreate = TBEvidenceTrainingModel::create([
                'name' => $fileName,
                'ubication' => $folder,
            ]);
            $document_id = $documentCreate->id;
        }
    }

    public function update($id)
    {
        try {
            DB::beginTransaction();
            $register = TBUserTrainingModel::findOrFail($id);
            $document_id = null;
            $this->verifyDocument($document_id);
            $register->update([
                'type_id' => $this->type_id,
                'name_id' => $this->name_id,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'credential_id' => $this->credential_id,
                'credential_url' => $this->credential_url,
                'isChecked' => $this->isChecked,
                'validity' => $this->validity,
                'validityStatus' => $this->validityStatus === 'Vencido' ? false : true,
                'evidence_id' => $document_id,
                'empleado_id' => $this->empleado_id,
            ]);
            DB::commit();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            DB::rollback();

            return false;
        }
    }

    public function fillData(array $data)
    {
        $this->fill($data);
    }

    public function store()
    {
        DB::beginTransaction();
        $document_id = null;
        $this->verifyDocument($document_id);
        try {
            TBUserTrainingModel::create([
                'type_id' => $this->type_id,
                'name_id' => $this->name_id,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'credential_id' => $this->credential_id,
                'credential_url' => $this->credential_url,
                'isChecked' => $this->isChecked,
                'validity' => $this->validity,
                'validityStatus' => $this->validityStatus === 'Vencido' ? false : true,
                'evidence_id' => $document_id,
                'empleado_id' => $this->empleado_id,
            ]);
            DB::commit();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            DB::rollback();

            return false;
        }
    }
}
