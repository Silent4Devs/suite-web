<?php

namespace App\Http\Livewire\Visitantes;

use App\Mail\Visitantes\NotificarIngresoVisitante;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Visitantes\RegistrarVisitante;
use App\Models\Visitantes\ResponsableVisitantes;
use App\Models\Visitantes\VisitantesDispositivo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
    public $dispositivos;

    public $nombre;

    public $apellidos;

    public $correo;

    public $celular;

    public $dispositivo;

    public $empresa;

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
        'registrarVisitante' => 'nullable',
    ];

    protected $listeners = ['imprimirCredencialImage'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount()
    {
        $this->fill([
            'dispositivos' => collect([[
                'dispositivo' => '',
                'marca' => '',
                'serie' => '',
            ]]),
        ]);

        $this->empleados = Empleado::alta()->orderBy('name')->get();
        $this->areas = Area::orderBy('area')->get();
    }

    public function render()
    {
        return view('livewire.visitantes.registro-visitantes');
    }

    public function addInput()
    {
        $this->dispositivos->push([
            'dispositivo' => '',
            'marca' => '',
            'serie' => '',
        ]);
    }

    // public function updatedNombre($value)
    // {
    //TODO:Buscador de coincidencias
    //     $coincidencias = RegistrarVisitante::where('nombre', 'ILIKE', "{$value}")->orWhere('apellidos', 'ILIKE', "{$value}")->get();
    //     $this->emit('coincidenciasNombreVisitantes', $coincidencias);
    // }

    public function removeInput($key)
    {
        $this->dispositivos->pull($key);
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
            $this->castEmpleado = Empleado::getAll()->find($this->empleado_id);
            $this->castArea = Area::getAll()->find($this->area_id);
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
        } elseif ($this->currentStep == 2) {
            $this->showStepOne = false;
            $this->showStepTwo = true;
            $this->showStepThree = false;
            $this->showStepFour = false;
        } elseif ($this->currentStep == 3) {
            $this->showStepOne = false;
            $this->showStepTwo = false;
            $this->showStepThree = true;
            $this->showStepFour = false;
        } elseif ($this->currentStep == 4) {
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
                'dispositivos' => $this->dispositivos,
                'motivo' => $this->motivo,
                'foto' => $this->foto,
                'empleado' => [
                    'id' => $this->empleado_id,
                    'name' => $castEmpleado ? $castEmpleado->name : '',
                    'area' => $castEmpleado ? $castEmpleado->area : '',
                    'puesto' => $castEmpleado ? $castEmpleado->puesto : '',
                    'avatar' => $castEmpleado ? $castEmpleado->avatar : '',
                ],
                'area' => [
                    'id' => $this->area_id,
                    'area' => $castArea ? $castArea->area : '',
                ],
                'tipo_visita' => $this->tipo_visita,
            ];
        }
    }

    public function validateData()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'nombre' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'correo' => 'required|email|max:255',
                'celular' => 'nullable|regex:/[0-9]{10}/',
                'dispositivo' => 'nullable|string|max:255',
                'serie' => 'nullable|string|max:255',
                'motivo' => 'required|string',
                'dispositivos.*.dispositivo' => 'required_unless:dispositivos.*.serie,""|required_unless:dispositivos.*.marca,""',
                'dispositivos.*.marca' => 'required_unless:dispositivos.*.dispositivo,""|required_unless:dispositivos.*.serie,""',
                'dispositivos.*.serie' => 'required_unless:dispositivos.*.dispositivo,""|required_unless:dispositivos.*.marca,""',
            ], [
                'dispositivos.*.dispositivo.required_unless' => 'El campo dispositivo es requerido cuando se ha ingresado información en alguno de los campos contiguos',
                'dispositivos.*.marca.required_unless' => 'El campo marca es requerido cuando se ha ingresado información en alguno de los campos contiguos',
                'dispositivos.*.serie.required_unless' => 'El campo serie es requerido cuando se ha ingresado información en alguno de los campos contiguos',
                'celular' => 'El formato del celular debe ser de 10 digitos',
            ]);
        } elseif ($this->currentStep == 2) {
            if (ResponsableVisitantes::first()) {
                if (ResponsableVisitantes::first()->fotografia_requerida) {
                    $this->validate([
                        'foto' => 'required',
                    ], [
                        'foto.required' => 'Es requerido por la organización que se tome una fotografia para ingresar',
                    ]);
                } else {
                    $this->validate([
                        'foto' => 'nullable',
                    ]);
                }
            }
        } elseif ($this->currentStep == 3) {
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
            'email' => removeUnicodeCharacters($this->correo),
            'celular' => $this->celular,
            'dispositivo' => $this->dispositivo,
            'serie' => $this->serie,
            'motivo' => $this->motivo,
            'foto' => $this->foto,
            'empleado_id' => $this->empleado_id,
            'area_id' => $this->area_id,
            'tipo_visita' => $this->tipo_visita,
            'uuid' => Str::uuid(),
        ]);
        $registrarDispositivos = true;
        if ($this->dispositivos->count() == 1) {
            foreach ($this->dispositivos as $item) {
                if ($item['dispositivo'] == '' && $item['serie'] == '') {
                    $registrarDispositivos = false;
                }
            }
        }
        if ($registrarDispositivos) {
            $this->registrarDispositivos();
        }
        $this->enviarCorreoDeConfirmacion($this->correo, $this->registrarVisitante);
        $this->alert('success', 'Bien Hecho ' . $this->nombre . ', te has registrado correctamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);

        $this->emit('guardarRegistroVisitante', $this->registrarVisitante);
    }

    public function enviarCorreoDeConfirmacion($correo, $visitante)
    {
        Mail::to(removeUnicodeCharacters($correo))->send(new NotificarIngresoVisitante($visitante));
    }

    public function registrarDispositivos()
    {
        foreach ($this->dispositivos as $dispositivo) {
            VisitantesDispositivo::create([
                'registrar_visitante_id' => $this->registrarVisitante->id,
                'dispositivo' => $dispositivo['dispositivo'],
                'marca' => $dispositivo['marca'],
                'serie' => $dispositivo['serie'],
            ]);
        }
    }

    public function imprimirCredencial()
    {
        $this->emit('imprimirCredencialSelf');
    }

    public function imprimirCredencialImage($dataImage)
    {
        $pdf = \PDF::loadView('visitantes.credencial.index', ['credencial' => $dataImage])->output();
        $fileName = 'Credencial de ' . $this->registrarVisitante->nombre . ' ' . $this->registrarVisitante->apellidos . '.pdf';

        return response()->streamDownload(
            function () use ($pdf) {
                echo $pdf;
                $this->alert('success', 'Bien Hecho ' . $this->nombre . ', se ha imprimido correctamente la credencial', [
                    'position' => 'top-end',
                    'timer' => 1000,
                    'toast' => true,
                ]);
                $this->emit('credencialImpresa');
            },
            $fileName,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]
        );
    }
}
