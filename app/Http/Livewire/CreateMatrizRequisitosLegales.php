<?php

namespace App\Http\Livewire;

use App\Mail\MatrizEmail;
use App\Models\ControlListaDistribucion;
use App\Models\ListaDistribucion;
use App\Models\MatrizRequisitoLegale;
use App\Models\ProcesosListaDistribucion;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CreateMatrizRequisitosLegales extends Component
{
    public $modelo = 'MatrizRequisitoLegale';

    public collection $alcance_s1;

    public $alcance;

    public $bandera = true;

    public $bandera2 = false;

    protected $listeners = [
        'renderMatriz' => 'render',
    ];

    public function mount()
    {
        $this->alcance_s1 = new Collection();
    }

    public function render()
    {
        return view('livewire.create-matriz-requisitos-legales');
    }

    public function addAlcance1()
    {
        $this->alcance_s1->push([
            'nombrerequisito' => '',
        ]);
        $this->emit('renderMatriz');

        $this->bandera = false;
        $this->bandera2 = false;
    }

    public function removeAlcance1($index)
    {
        unset($this->alcance_s1[$index]);
        $this->bandera = true;
    }

    public function save()
    {
        // dd($this->alcance, $this->alcance_s1);
        DB::beginTransaction();

        $array_requisito = [];

        try {
            $requisito = MatrizRequisitoLegale::create([
                'nombrerequisito' => $this->alcance['nombrerequisito'],
                'formacumple' => $this->alcance['formacumple'],
                'fechaexpedicion' => $this->alcance['fechaexpedicion'],
                'fechavigor' => $this->alcance['fechavigor'],
                'requisitoacumplir' => $this->alcance['requisitoacumplir'],
            ]);
            foreach ($this->alcance_s1 as $alcance1) {
                $array_requisito[] = MatrizRequisitoLegale::create([
                    'nombrerequisito' => $alcance1['nombrerequisito'],
                    'formacumple' => $alcance1['formacumple'],
                    'fechaexpedicion' => $alcance1['fechaexpedicion'],
                    'fechavigor' => $alcance1['fechavigor'],
                    'requisitoacumplir' => $alcance1['requisitoacumplir'],
                ]);
            }
            DB::commit();

            $this->listaDistribucion($requisito, $array_requisito);

            return redirect()->route('admin.matriz-requisito-legales.index');
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }

    public function listaDistribucion($requisito, $array_requisito)
    {
        // dd($requisito, $array_requisito);
        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();
        $creador = User::getCurrentUser()->empleado->id; // Replace 123 with your specific empleado_id value
        // $no_niveles = $lista->niveles;
        // dd($lista, $no_niveles);

        $proceso = ProcesosListaDistribucion::updateOrCreate(
            [
                'modulo_id' => $lista->id,
                'proceso_id' => $requisito->id, //Este es solo el numero del id del respectivo FODA, no esta relacionado a nada, pero se necesita el valor
            ],
            [
                'estatus' => 'Pendiente',
            ]
        );
        // dd($lista, $id_foda, $this->modelo, $proceso);

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
        $containsValue = $lista->participantes->contains('empleado_id', $creador);

        if (! $containsValue) {
            // dd("Estoy en la lista");
            $this->envioCorreos($proceso, $requisito);
            // The collection contains the specific empleado_id value
            // Your logic here...
        }

        foreach ($array_requisito as $requisito) {
            $proceso = ProcesosListaDistribucion::updateOrCreate(
                [
                    'modulo_id' => $lista->id,
                    'proceso_id' => $requisito->id, //Este es solo el numero del id del respectivo FODA, no esta relacionado a nada, pero se necesita el valor
                ],
                [
                    'estatus' => 'Pendiente',
                ]
            );
            // dd($lista, $id_foda, $this->modelo, $proceso);

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
            $containsValue = $lista->participantes->contains('empleado_id', $creador);

            if (! $containsValue) {
                // dd("Estoy en la lista");
                $this->envioCorreos($proceso, $requisito);
                // The collection contains the specific empleado_id value
                // Your logic here...
            }
        }
    }

    public function envioCorreos($proceso, $requisito)
    {
        foreach ($proceso->participantes as $part) {
            $emailAprobador = $part->participante->empleado->email;
            Mail::to(removeUnicodeCharacters($emailAprobador))->send(new MatrizEmail($requisito->id));
        }
        // dd("Se enviaron todos");
    }
}
