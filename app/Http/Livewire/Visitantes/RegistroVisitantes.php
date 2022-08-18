<?php

namespace App\Http\Livewire\Visitantes;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Visitantes\RegistrarVisitante;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RegistroVisitantes extends Component
{
    use LivewireAlert;
    public $totalSteps = 4;
    public $currentStep = 1;
    public $empleados;
    public $areas;
    // step 1
    public $nombre;
    public $apellidos;
    public $dispositivo;
    public $serie;
    public $motivo;
    // step 2
    public $foto;
    // step 3
    public $empleado_id;
    public $castEmpleado;
    public $area_id;
    public $castArea;
    public $tipo_visita = 'persona';

    public $visitanteFake = [];
    public $registrarVisitante;
    public $showStepOne = true;
    public $showStepTwo = false;
    public $showStepThree = false;
    public $showStepFour = false;

    protected $rules = [
        'registrarVisitante' => 'nullable'
    ];

    public function mount()
    {
        $this->empleados = Empleado::alta()->orderBy('name')->get();
        $this->areas = Area::orderBy('area')->get();
    }

    public function render()
    {
        return view('livewire.visitantes.registro-visitantes');
    }

    public function goToStep($step)
    {

        if ($step > $this->currentStep) {
            $this->validateData();
            $this->currentStep = $step;
            $this->showStepByCurrent();
        } else {
            $this->currentStep = $step;
            $this->showStepByCurrent();
        }
    }

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        $this->showStepByCurrent();
        $this->emit('increaseStepVisitantes', $this->currentStep);
        if ($this->currentStep == 4) {
            $this->castEmpleado = Empleado::find($this->empleado_id);
            $this->castArea = Area::find($this->area_id);
        }
        if ($this->currentStep > $this->totalSteps) {
            $this->emit('finalizarRegistroVisitante');
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->emit('decreaseStep');
        $this->currentStep--;
        $this->showStepByCurrent();
    }

    public function showStepByCurrent()
    {
        if ($this->currentStep == 1) {
            $this->showStepOne = true;
            $this->showStepTwo = false;
            $this->showStepThree = false;
            $this->showStepFour = false;
        } else if ($this->currentStep == 2) {
            $this->showStepOne = false;
            $this->showStepTwo = true;
            $this->showStepThree = false;
            $this->showStepFour = false;
        } else if ($this->currentStep == 3) {
            $this->showStepOne = false;
            $this->showStepTwo = false;
            $this->showStepThree = true;
            $this->showStepFour = false;
        } else if ($this->currentStep == 4) {
            $this->showStepOne = false;
            $this->showStepTwo = false;
            $this->showStepThree = false;
            $this->showStepFour = true;
            $castEmpleado = Empleado::with('area')->find($this->empleado_id);
            $castArea = Area::find($this->area_id);
            $this->visitanteFake = [
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos,
                'dispositivo' => $this->dispositivo,
                'serie' => $this->serie,
                'motivo' => $this->motivo,
                'foto' => $this->foto,
                'empleado' => [
                    'id' => $this->empleado_id,
                    'name' => $castEmpleado ? $castEmpleado->name : '',
                    'area' => $castEmpleado ? $castEmpleado->area->area : '',
                    'avatar' => $castEmpleado ? $castEmpleado->avatar : ''
                ],
                'area' => [
                    'id' => $this->area_id,
                    'area' => $castArea ? $castArea->area : '',
                ],
                'tipo_visita' => $this->tipo_visita
            ];
        }
    }

    public function validateData()
    {

        if ($this->currentStep == 1) {
            $this->validate([
                'nombre' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'dispositivo' => 'nullable|string|max:255',
                'serie' => 'nullable|string|max:255',
                'motivo' => 'required|string',
            ]);
        } else if ($this->currentStep == 2) {
            $this->validate([
                'foto' => 'nullable'
            ]);
        } else if ($this->currentStep == 3) {
            $this->validate([
                'tipo_visita' => 'required',
            ]);
            if ($this->tipo_visita == 'persona') {
                $this->validate([
                    'empleado_id' => 'required|integer',
                ]);
            }
            if ($this->tipo_visita == 'area') {
                $this->validate([
                    'area_id' => 'required|integer',
                ]);
            }
        }
    }

    public function guardarRegistroVisitante()
    {
        $this->registrarVisitante = RegistrarVisitante::create([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'dispositivo' => $this->dispositivo,
            'serie' => $this->serie,
            'motivo' => $this->motivo,
            'foto' => $this->foto,
            'empleado_id' => $this->empleado_id,
            'area_id' => $this->area_id,
            'tipo_visita' => $this->tipo_visita,
        ]);
        $this->alert('success', 'Bien Hecho ' . $this->nombre . ', te has registrado correctamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->emit('guardarRegistroVisitante', $this->registrarVisitante);
    }

    public function imprimirCredencial()
    {
        $pdf = \PDF::loadView('visitantes.credencial.index', ['visitante' => $this->registrarVisitante])->output();
        $fileName = 'credencial' . $this->registrarVisitante->nombre . '' . $this->registrarVisitante->apellidos . '.pdf';
        return response()->streamDownload(
            function () use ($pdf) {
                echo ($pdf);
                $this->alert('success', 'Bien Hecho ' . $this->nombre . ', se ha imprimido correctamente la credencial', [
                    'position' => 'top-end',
                    'timer' => 1000,
                    'toast' => true,
                ]);
                $this->emit('imprimirCredencial');
            },
            $fileName,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
            ]
        );
    }
}
