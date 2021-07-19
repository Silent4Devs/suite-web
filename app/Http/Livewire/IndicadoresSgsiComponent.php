<?php

namespace App\Http\Livewire;

use App\Models\Proceso;
use Livewire\Component;
use App\Models\Empleado;
use App\Models\Indicador;
use App\Models\VariablesIndicador;
use App\Models\EvaluacionIndicador;

class IndicadoresSgsiComponent extends Component
{
    public $nombre, $description, $formula, $frecuencia, $unidadmedida, $meta, $no_revisiones, $resultado, $id_empleado, $id_proceso, $indicadoresSgsis;
    public $view = 'create';
    public $formSlugs, $customFields, $fecha;
    public $variable, $valor, $formula_calcular, $value, $remplazo_formula, $evaluacion;

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
        $evaluaciones = EvaluacionIndicador::where('id_indicador', '=', $this->indicadoresSgsis->id)->get();

        return view('livewire.indicadores-sgsi-component', [
            'responsables' => $responsables,
            'procesos' => $procesos,
            'indicadoresSgsis' => $this->indicadoresSgsis,
            'customFields' => $this->customFields,
            'evaluaciones' => $evaluaciones,
        ]);
    }

    public function default()
    {
        $this->evaluacion = "";
        $this->fecha = "";
        $this->dispatchBrowserEvent('contentChanged');
        $this->emit('contentChanged');

        $this->view = 'create';
    }

    public function store()
    {
        $variables = array();
        $valores = array();
        $formula_sustitucion = $this->indicadoresSgsis->formula;

        foreach ($this->formSlugs as $key => $v1) {
            array_push($variables, array_keys($v1)[0]);
            array_push($valores, array_values($v1)[0]);
        }

        $formula_final = str_replace($variables, $valores, $formula_sustitucion);
        //dd($this->formSlugs, $variables, $valores, str_replace(".", "",$formula_final));
        $result = eval('return ' . $formula_final . ';');

        $evaluaciones = EvaluacionIndicador::create([
            'evaluacion' => $this->evaluacion,
            'fecha' => $this->fecha,
            'resultado' => $result,
            'id_indicador' => $this->indicadoresSgsis->id,
        ]);

        $this->default();

        $this->alert('success', 'Registro añadido!');

        //dd($this->indicadoresSgsis->id ,$this->fecha, $this->evaluacion, $result);
    }
}
