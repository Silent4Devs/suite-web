<?php

namespace App\Http\Livewire;

use App\Models\Proceso;
use Livewire\Component;
use App\Models\Empleado;
use App\Models\Indicador;
use App\Models\VariablesIndicador;

class IndicadoresSgsiComponent extends Component
{
    public $nombre, $description, $formula, $frecuencia, $unidadmedida, $meta, $no_revisiones, $resultado, $id_empleado, $id_proceso, $indicadoresSgsis;
    public $view = 'create';
    public $vars = [];
    public $variable, $valor, $formula_calcular;
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->vars, $i);
    }

    public function remove($i)
    {
        unset($this->vars[$i]);
    }

    public function mount($indicadoresSgsis)
    {
        $this->indicadoresSgsis = $indicadoresSgsis;
    }

    public function render()
    {
        $responsables = Empleado::get();
        $procesos = Proceso::get();
        $VariablesIndicadores = VariablesIndicador::get();

        return view('livewire.indicadores-sgsi-component', [
            'responsables' => $responsables,
            'procesos' => $procesos,
            'indicadoresSgsis' => $this->indicadoresSgsis,
            'variables' => $VariablesIndicadores,
        ]);
    }

    private function resetInputFields()
    {
        $this->variable = '';
        $this->valor = '';
    }

    public function enviarVars()
    {

        dd($this->formula);
        $validatedDate = $this->validate(
            [

                'variable.0' => 'required',

                'valor.0' => 'required',

                'variable.*' => 'required',

                'valor.*' => 'required',

            ],

            [

                'variable.0.required' => 'La variable es obligatoria',

                'valor.0.required' => 'El valor es obligatorio',

                'variable.*.required' => 'La variable es obligatoria',

                'valor.*.required' => 'El valor es obligatorio',

            ]

        );

        foreach ($this->variable as $key => $value) {

            VariablesIndicador::create(['variable' => $this->variable[$key], 'valor' => $this->valor[$key]]);
        }

        $this->vars = [];

        $this->resetInputFields();
    }

    public function calculo()
    {
        dd($this->formula);
    }
}
