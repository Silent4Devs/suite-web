<?php

namespace App\Livewire\Training;

use App\Livewire\Forms\CatalogueTraining\CatalogueTrainingForm;
use App\Livewire\Forms\Certificates\TrainingForm;
use App\Mail\CertificatesMail;
use App\Models\ControlListaDistribucion;
use App\Models\ListaDistribucion;
use App\Models\ProcesosListaDistribucion;
use App\Models\TBCatalogueTrainingModel;
use App\Models\TBEvidenceTrainingModel;
use App\Models\TBTypeCatalogueTrainingModel;
use App\Models\TBUserTrainingModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Training extends Component
{
    use WithFileUploads;

    // use Http;
    public TrainingForm $form;

    public CatalogueTrainingForm $modalForm;

    public $types;

    public Collection $names;

    public $empleado_id;

    public $registers;

    public $status = 'create';

    public $id;

    public $modelo = 'TBCatalogueTrainingModel';

    public function solicitudAprobacion($id)
    {
        $certificate = TBCatalogueTrainingModel::find($id);
        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();
        $proceso = ProcesosListaDistribucion::updateOrCreate(
            [
                'modulo_id' => $lista->id,
                'proceso_id' => $id,
            ],
            [
                'estatus' => 'Pendiente',
            ]
        );

        foreach ($lista->participantes as $participante) {
            $participantes = ControlListaDistribucion::updateOrCreate(
                [
                    'proceso_id' => $proceso->id,
                    'participante_id' => $participante->id,
                ],
                [
                    'estatus' => 'Pendiente',
                ]
            );
        }

        //Superaprobadores
        foreach ($proceso->participantes as $part) {
            if ($part->participante->nivel == 0) {
                $emailSuperAprobador = $part->participante->empleado->email;
                Mail::to(removeUnicodeCharacters($emailSuperAprobador))->queue(new CertificatesMail($id, $certificate->name));
                // dd('primer usuario', $part->participante);
            }
        }

        //Aprobadores normales
        // for ($i = 1; $i <= $no_niveles; $i++) {
        foreach ($proceso->participantes as $part) {
            if ($part->participante->nivel == 1) {
                // for ($j = 1; $j <= 5; $j++) {
                if ($part->participante->numero_orden == 1) {
                    $emailAprobador = $part->participante->empleado->email;
                    Mail::to(removeUnicodeCharacters($emailAprobador))->queue(new CertificatesMail($certificate->id, $certificate->name));
                    break;
                }
                // }
            }
            // }
        }
        // $certificate->update([
        //     'estatus' => 'Pendiente',
        // ]);

        // $control_participantes = ControlListaDistribucion::where('proceso_id', '=', $proceso->id)->get();
        // dd($proceso, $control_participantes);
        // return redirect(route('admin.entendimiento-organizacions.index'));
    }

    public function downloadEvidencie($id)
    {
        $evidenceRegister = TBEvidenceTrainingModel::findOrFail($id);
        $filePath = $evidenceRegister->ubication.'/'.$evidenceRegister->name;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }
    }

    public function edit()
    {
        $succes = $this->form->update($this->id);
        if ($succes) {
            $this->dispatch('edited');
            $this->status = 'create';
        } else {
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
        $register->validityStatus = $register->validityStatus ? 'Vigente' : 'Vencido';
        $this->form->fillData($register->toArray());
    }

    public function saveModal()
    {
        $succes = $this->modalForm->userStore();
        if ($succes) {
            $this->dispatch('requestApprove');
            $this->solicitudAprobacion($succes);
        } else {
            $this->dispatch('error');
        }
    }

    public function save()
    {
        $this->form->empleado_id = $this->empleado_id;
        $succes = $this->form->store();
        if ($succes) {
            $this->dispatch('saved');
        } else {
            $this->dispatch('error');
        }
    }

    public function verifyStatus()
    {
        $date = Carbon::now();
        if ($date >= $this->form->validity) {
            $this->form->validityStatus = 'Vencido';
        } else {
            $this->form->validityStatus = 'Vigente';
        }
    }

    public function chanceChecked()
    {
        $this->form->isChecked = ! $this->form->isChecked;
        if ($this->form->isChecked === false) {
            $this->form->validity = '';
            $this->form->validityStatus = '';
        }
    }

    public function getCatalogueName()
    {
        $type_id = intval($this->form->type_id);
        foreach ($this->types as $type) {
            if ($type->id === $type_id) {
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
        $types = TBTypeCatalogueTrainingModel::orderBy('name', 'asc')->get();
        $registers = TBUserTrainingModel::where('empleado_id', $this->empleado_id)->orderBy('id')->get();
        $this->types = $types;
        foreach ($registers as $register) {
            $register->start_date = Carbon::parse($register->start_date)->format('d-m-Y');
            $register->end_date = Carbon::parse($register->end_date)->format('d-m-Y');
            if ($register->validity) {
                $register->validity = Carbon::parse($register->validity)->format('d-m-Y');
            }
        }
        $this->registers = $registers;

        return view('livewire.training.training');
    }
}
