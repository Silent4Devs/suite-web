<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Empleado;
use App\Models\EvaluacionObjetivo;
use App\Models\VariablesObjetivosseguridad;

class ObjetivosSeguridadComponent extends Component
{
    public $nombre, $description, $formula, $frecuencia, $unidadmedida, $meta, $no_revisiones, $resultado, $id_empleado, $id_proceso, $objetivos;
    public $view = 'create';
    public $formSlugs, $customFields, $fecha, $id_evaluacion;
    public $variable, $valor, $formula_calcular, $value, $remplazo_formula, $evaluacion;

    public function mount($objetivos)
    {
        $this->objetivos = $objetivos;
        $this->customFields = VariablesObjetivosseguridad::where('id_objetivo', '=', $this->objetivos->id)->get();

        $data = [];
        $this->formSlugs = collect($this->customFields)->map(function ($value) use ($data) {
            $data[$value->variable] = '';

            return $data;
        })->toArray();
    }

    public function render()
    {
        $responsables = Empleado::get();
        $evaluaciones = EvaluacionObjetivo::where('id_objetivo', '=', $this->objetivos->id)->get();

        return view('livewire.objetivos-seguridad-component', [
            'responsables' => $responsables,
            'objetivos' => $this->objetivos,
            'customFields' => $this->customFields,
            'evaluaciones' => $evaluaciones,
        ]);
    }

    public function store()
    {
        $variables = array();
        $valores = array();
        $formula_sustitucion = $this->objetivos->formula;

        foreach ($this->formSlugs as $key => $v1) {
            array_push($variables, array_keys($v1)[0]);
            array_push($valores, array_values($v1)[0]);
        }

        $formula_final = str_replace($variables, $valores, $formula_sustitucion);
        //dd($this->formSlugs, $variables, $valores, str_replace(".", "",$formula_final));
        $result = eval('return ' . $formula_final . ';');

        $evaluaciones = EvaluacionObjetivo::create([
            'evaluacion' => $this->evaluacion,
            'fecha' => $this->fecha,
            'resultado' => $result,
            'id_objetivo' => $this->objetivos->id,
        ]);

        $this->default();

        $this->alert('success', 'Registro añadido!');
    }

    public function default()
    {
        $this->evaluacion = "";
        $this->fecha = "";
        $this->dispatchBrowserEvent('contentChanged');
        $this->emit('contentChanged');

        $this->view = 'create';
    }
}
