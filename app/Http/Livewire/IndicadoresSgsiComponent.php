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
    public $formSlugs, $customFields;
    public $variable, $valor, $formula_calcular, $value;

    public function mount($indicadoresSgsis)
    {
        $this->indicadoresSgsis = $indicadoresSgsis;
        $this->customFields = VariablesIndicador::where('id_indicador', '=', $this->indicadoresSgsis->id)->get();

        $data = [];
        $this->formSlugs = collect($this->customFields)->map(function ($value) use ($data) {
            $data[$value->variable] = '';
            return $data;
        })->toArray();
    }

    public function render()
    {
        $responsables = Empleado::get();
        $procesos = Proceso::get();

        return view('livewire.indicadores-sgsi-component', [
            'responsables' => $responsables,
            'procesos' => $procesos,
            'indicadoresSgsis' => $this->indicadoresSgsis,
            'customFields' => $this->customFields,
        ]);
    }

    private function resetInputFields()
    {
        $this->variable = '';
        $this->valor = '';
    }

    public function store()
    {
        $variables = array();
        $valores = array();
        $formula_sustitucion = $this->indicadoresSgsis->formula;

        foreach ($this->formSlugs as $key =>$v1) {

            array_push($variables, $v1);
            foreach ($v1 as $key => $v2) {
                array_push($valores, $v2);
            }
        }

        dd($variables, $valores, $this->indicadoresSgsis->formula);
    }
}
