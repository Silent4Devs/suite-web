<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Models\EvaluacionIndicador;
use App\Models\IndicadoresSgsi;
use App\Models\Proceso;
use App\Models\VariablesIndicador;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class IndicadoresSgsiComponent extends Component
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

    public $indicadoresSgsis;

    public $inpvar;

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
        'formSlugs.*.*' => 'required',
    ];

    protected $mesages = [
        'evaluacion.required' => 'Debes de definir una evaluación',
        'fecha.required' => 'Debes seleccionar una fecha',
        'formSlugs.*.*.required' => 'Agrega la evaluación',
    ];

    public function mount($indicadoresSgsis, $inpvar)
    {
        $this->indicadoresSgsis = $indicadoresSgsis;
        // dd($indicadoresSgsis);
        // $this->customFields = VariablesIndicador::where('id_indicador', '=', $this->indicadoresSgsis->id)
        // ->where('variable', '!=', $this->indicadoresSgsis->formula)->get();

        $this->formula = IndicadoresSgsi::find($this->indicadoresSgsis->id);

        // dd($this->formula->formula);

        $finish_array = [];
        // dd('Como llega?', $inpvar);
        if (array_key_exists('variables', $inpvar) === true) {
            foreach ($inpvar['variables'] as $result) {
                if (strstr($result, '$')) {
                    array_push($finish_array, $result);
                }
            }
        } else {
            foreach ($inpvar as $result) {
                array_push($finish_array, $result);
            }
        }

        $this->customFields = $finish_array;

        $data = [];
        $this->formSlugs = collect($finish_array)->map(function ($value) use ($data) {
            $data[$value] = '';

            return $data;
        })->toArray();
        // dd($this->formSlugs);
    }

    public function render()
    {
        $responsables = Empleado::getaltaAll();
        $procesos = Proceso::getAll();
        $evaluaciones = EvaluacionIndicador::where('id_indicador', '=', $this->indicadoresSgsis->id)->get();

        return view('livewire.indicadores-sgsi-component', [
            'responsables' => $responsables,
            'procesos' => $procesos,
            'indicadoresSgsis' => $this->indicadoresSgsis,
            'customFields' => $this->customFields,
            'evaluaciones' => $evaluaciones,
        ]);
    }

    public function store()
    {
        $this->validate();

        $variables = [];
        $valores = [];
        $formula_sustitucion = $this->indicadoresSgsis->formula;

        foreach ($this->formSlugs as $key => $v1) {
            array_push($variables, array_keys($v1)[0]);
            array_push($valores, array_values($v1)[0]);
        }

        $formula_final = str_replace($variables, $valores, $formula_sustitucion);

        try {
            $result = eval('return '.$formula_final.';');
        } catch (\Throwable $th) {
            if ($th->getMessage() == 'Division by zero') {
                $result = 0;
            } else {
                $result = 0;
            }
        }

        $evaluaciones = EvaluacionIndicador::create([
            'evaluacion' => $this->evaluacion,
            'fecha' => $this->fecha,
            'resultado' => $result,
            'id_indicador' => $this->indicadoresSgsis->id,
        ]);

        $this->default();

        $this->alert('success', 'Registro añadido!');
    }

    public function edit($id)
    {
        $evaluaciones = EvaluacionIndicador::find($id);
        $this->evaluacion = $evaluaciones->evaluacion;
        $this->fecha = $evaluaciones->fecha;
        //$this->resultado = $evaluaciones->resultado;
        // $this->default();
        $this->view = 'edit';

        $this->id_evaluacion = $evaluaciones->id;
    }

    public function update()
    {
        $evaluaciones = EvaluacionIndicador::find($this->id_evaluacion);

        $variables = [];
        $valores = [];
        $formula_sustitucion = $this->indicadoresSgsis->formula;

        foreach ($this->formSlugs as $key => $v1) {
            array_push($variables, array_keys($v1)[0]);
            array_push($valores, array_values($v1)[0]);
        }

        $formula_final = str_replace($variables, $valores, $formula_sustitucion);
        //dd($this->formSlugs, $variables, $valores, str_replace(".", "",$formula_final));
        try {
            $result = eval('return '.$formula_final.';');
        } catch (\Throwable $th) {
            if ($th->getMessage() == 'Division by zero') {
                $result = 0;
            } else {
                $result = 0;
            }
        }

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
        EvaluacionIndicador::destroy($id);

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
