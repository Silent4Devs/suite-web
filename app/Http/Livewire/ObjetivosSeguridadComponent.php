<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Models\EvaluacionObjetivo;
use App\Models\VariablesObjetivosseguridad;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ObjetivosSeguridadComponent extends Component
{
    use LivewireAlert;

    public $nombre;
    public $description;
    public $formula;
    public $frecuencia;
    public $unidadmedida;
    public $meta;
    public $no_revisiones;
    public $resultado;
    public $id_empleado;
    public $id_proceso;
    public $objetivos;
    public $view = 'create';
    public $formSlugs;
    public $customFields;
    public $fecha;
    public $id_evaluacion;
    public $variable;
    public $valor;
    public $formula_calcular;
    public $value;
    public $remplazo_formula;
    public $evaluacion;

    public function mount($objetivos)
    {
        $this->objetivos = $objetivos;
        $this->customFields = VariablesObjetivosseguridad::where('id_objetivo', '=', $this->objetivos->id)->get();

        $data = [];
        $this->formSlugs = collect($this->customFields)->map(function ($value) use ($data) {
            $data[$value->variable] = 0;

            return $data;
        })->toArray();
    }

    public function render()
    {
        $responsables = Empleado::alta()->get();
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
        $variables = [];
        $valores = [];
        $formula_sustitucion = $this->objetivos->formula;

        foreach ($this->formSlugs as $key => $v1) {
            array_push($variables, array_keys($v1)[0]);
            array_push($valores, array_values($v1)[0]);
        }
        $formula_final = str_replace($variables, $valores, $formula_sustitucion);
        // dd($this->formSlugs, $variables, $valores, str_replace(".", "", $formula_final));
        // $formula_final = str_replace(" ", "_", $formula_final);

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

    public function edit($id)
    {
        $evaluaciones = EvaluacionObjetivo::find($id);
        $this->evaluacion = $evaluaciones->evaluacion;
        $this->fecha = $evaluaciones->fecha;
        //$this->resultado = $evaluaciones->resultado;
        $this->view = 'edit';
        $this->id_evaluacion = $evaluaciones->id;
    }

    public function update()
    {
        $evaluaciones = EvaluacionObjetivo::find($this->id_evaluacion);

        $variables = [];
        $valores = [];
        $formula_sustitucion = $this->objetivos->formula;

        foreach ($this->formSlugs as $key => $v1) {
            array_push($variables, array_keys($v1)[0]);
            array_push($valores, array_values($v1)[0]);
        }

        $formula_final = str_replace($variables, $valores, $formula_sustitucion);
        //dd($this->formSlugs, $variables, $valores, str_replace(".", "",$formula_final));
        $result = eval('return ' . $formula_final . ';');

        $evaluaciones->update([
            'evaluacion' => $this->evaluacion,
            'fecha' => $this->fecha,
            'resultado' => $result,
        ]);

        $this->default();
        $this->alert('success', 'Registro actualizado!');
    }

    public function delete($id)
    {
        EvaluacionObjetivo::destroy($id);
        $this->default();
        $this->alert('success', 'Registro eliminado!');
    }

    public function default()
    {
        $this->evaluacion = '';
        $this->fecha = '';

        $this->dispatchBrowserEvent('contentChanged');

        $this->view = 'create';
    }
}
