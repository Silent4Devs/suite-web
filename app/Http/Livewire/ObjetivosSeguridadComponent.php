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

    protected $rules = [
        'evaluacion' => 'required',
        'fecha' => 'required',
        'formSlugs' => 'required|array',
        'formSlugs.*' => 'required',
        'formSlugs.*.*' => 'required|numeric|min:1',
    ];

    protected $messages = [
        'evaluacion.required' => 'El campo evaluacion es requerido',
        'fecha.required' => 'El campo fecha es requerido',
        'formSlugs.required' => 'El campo es requerido',
        'formSlugs.array' => 'El campo debe ser un array',
        'formSlugs.*.required' => 'El campo es requerido',
        'formSlugs.*.min' => 'El campo debe ser mayor a 0',
        'formSlugs.*.*.required' => 'El :attribute es requerido',
        'formSlugs.*.*.numeric' => 'El :attribute debe ser un numero',
    ];

    public function mount($objetivos)
    {
        $this->objetivos = $objetivos;
        $this->customFields = VariablesObjetivosseguridad::where('id_objetivo', '=', $this->objetivos->id)->get();
        $data = [];
        $this->formSlugs = collect($this->customFields)->map(function ($value) use ($data) {
            $data[$value->variable] = null;

            return $data;
        })->toArray();
    }

    public function render()
    {
        $responsables = Empleado::getaltaAll();
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
        $this->validate();
        $variables = [];
        $valores = [];
        $formula_sustitucion = $this->objetivos->formula;

        foreach ($this->formSlugs as $key => $v1) {
            array_push($variables, array_keys($v1)[0]);
            array_push($valores, array_values($v1)[0]);
        }

        $formula_sustitucion = str_replace('$', '__', $formula_sustitucion);
        $formula_final = '';
        foreach ($variables as $idx => $var) {
            $var = str_replace('$', '__', $var);
            if ($formula_final != '') {
                $formula_final = preg_replace("/\b{$var}\b/", $valores[$idx], $formula_final);
            } else {
                $formula_final = preg_replace("/\b{$var}\b/", $valores[$idx], $formula_sustitucion);
            }
        }

        $result = eval('return ' . $formula_final . ';');
        EvaluacionObjetivo::create([
            'evaluacion' => $this->evaluacion,
            'fecha' => $this->fecha,
            'resultado' => round($result),
            'id_objetivo' => $this->objetivos->id,
        ]);
        $this->default();
        $this->alert('success', 'Registro añadido!');
    }

    public function edit($id)
    {
        $evaluaciones = EvaluacionObjetivo::find($id);
        $this->evaluacion = $evaluaciones->evaluacion;
        $this->fecha = $evaluaciones->fecha->format('Y-m-d');

        //$this->resultado = $evaluaciones->resultado;
        $this->view = 'edit';
        $this->id_evaluacion = $evaluaciones->id;
    }

    public function update()
    {
        $this->validate();
        $evaluaciones = EvaluacionObjetivo::find($this->id_evaluacion);
        $variables = [];
        $valores = [];
        $formula_sustitucion = $this->objetivos->formula;

        foreach ($this->formSlugs as $key => $v1) {
            array_push($variables, array_keys($v1)[0]);
            array_push($valores, array_values($v1)[0]);
        }

        $formula_sustitucion = str_replace('$', '__', $formula_sustitucion);
        $formula_final = '';
        foreach ($variables as $idx => $var) {
            $var = str_replace('$', '__', $var);
            if ($formula_final != '') {
                $formula_final = preg_replace("/\b{$var}\b/", $valores[$idx], $formula_final);
            } else {
                $formula_final = preg_replace("/\b{$var}\b/", $valores[$idx], $formula_sustitucion);
            }
        }

        $result = eval('return ' . $formula_final . ';');

        $evaluaciones->update([
            'evaluacion' => $this->evaluacion,
            'fecha' => $this->fecha,
            'resultado' => round($result),
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

        foreach ($this->formSlugs as $idx => $formSlug) {
            foreach ($formSlug as $key => $value) {
                $this->formSlugs[$idx][$key] = null;
            }
        }
        $this->dispatchBrowserEvent('contentChanged');
        $this->emit('limpiarSlugs');

        $this->view = 'create';
    }
}
