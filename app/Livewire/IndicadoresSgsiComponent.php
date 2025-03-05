<?php

namespace App\Livewire;

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

    public $rangos_ind;

    public $no_aplica = false;

    public $justificacion = null;

    // protected $rules = [
    //     'evaluacion' => 'required',
    //     'fecha' => 'required',
    //     'formSlugs.*.*' => 'required',
    // ];

    protected $mesages = [
        'evaluacion.required' => 'Debes de definir una evaluación',
        'fecha.required' => 'Debes seleccionar una fecha',
        'formSlugs.*.*.required' => 'Agrega la evaluación',
    ];

    public function rules()
    {
        $rules = [
            'evaluacion' => 'required',
            'fecha' => 'required',
            'no_aplica' => 'required|boolean'
        ];

        if ($this->no_aplica) {
            $rules['justificacion'] = 'required';
        } else {
            $rules['formSlugs.*.*'] = 'required';
        }

        return $rules;
    }

    public function mount($indicadoresSgsis, $inpvar)
    {
        $this->indicadoresSgsis = $indicadoresSgsis;

        // $this->customFields = VariablesIndicador::where('id_indicador', '=', $this->indicadoresSgsis->id)
        // ->where('variable', '!=', $this->indicadoresSgsis->formula)->get();

        $this->rangos_ind = $this->indicadoresSgsis->rangosIndicadoresSGSI;

        $finish_array = [];

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
    }

    public function render()
    {
        $this->formula = IndicadoresSgsi::find($this->indicadoresSgsis->id);
        $responsables = Empleado::getaltaAll();
        $procesos = Proceso::getAll();
        $evaluaciones = EvaluacionIndicador::where('id_indicador', '=', $this->indicadoresSgsis->id)->get();

        return view('livewire.indicadores-sgsi-component', [
            'responsables' => $responsables,
            'procesos' => $procesos,
            'indicadoresSgsis' => $this->indicadoresSgsis,
            'customFields' => $this->customFields,
            'evaluaciones' => $evaluaciones,
            'rangos_ind' =>$this->rangos_ind,
        ]);
    }

    public function store()
    {
        $this->validate();

        if (!$this->no_aplica)
        {
            $variables = [];
            $valores = [];
            $formula_sustitucion = $this->indicadoresSgsis->formula;

            foreach ($this->formSlugs as $key => $v1) {
                array_push($variables, array_keys($v1)[0]);
                array_push($valores, array_values($v1)[0]);
            }

            $formula_replace = str_replace($variables, $valores, $formula_sustitucion);

            $string = $formula_replace;
            $sinExclamacion = preg_replace('/[¡!]/u', '', $string);

            $formula_final = $sinExclamacion;

            try {
                $result = eval('return '.$formula_final.';');
            } catch (\Throwable $th) {
                if ($th->getMessage() == 'Division by zero') {
                    $result = 0;
                } else {
                    $result = 0;
                }
            }

            if (isset($this->rangos_ind->valor_maximo) && isset($this->rangos_ind->valor_minimo)) {
                if($result > $this->rangos_ind->valor_maximo || $result < $this->rangos_ind->valor_minimo){
                    $this->alert('error', 'El resultado de la operación:'. $result .' no se encuentra dentro de los valores limite del indicador');

                    return false;
                }
            }

        }else{
            $result = $this->indicadoresSgsis->verde;
        }

        $evaluaciones = EvaluacionIndicador::create([
            'evaluacion' => $this->evaluacion,
            'fecha' => $this->fecha,
            'resultado' => $result,
            'id_indicador' => $this->indicadoresSgsis->id,
            'no_aplica' => $this->no_aplica ?? false,
            'justificacion' => $this->justificacion ?? null,
            'id_rango_indicadores_sgsi' => $this->rangos_ind->id ?? null,
        ]);

        $this->default();

        $this->alert('success', 'Registro añadido!');
    }

    public function edit($id)
    {
        $evaluaciones = EvaluacionIndicador::find($id);
        $this->evaluacion = $evaluaciones->evaluacion;
        $this->fecha = $evaluaciones->fecha;
        $this->no_aplica = $evaluaciones->no_aplica;
        $this->justificacion = $evaluaciones->justificacion;
        // $this->resultado = $evaluaciones->resultado;
        // $this->default();
        $this->view = 'edit';

        $this->id_evaluacion = $evaluaciones->id;
    }

    public function update()
    {
        $evaluaciones = EvaluacionIndicador::find($this->id_evaluacion);

        if (!$this->no_aplica)
        {
            $variables = [];
            $valores = [];
            $formula_sustitucion = $this->indicadoresSgsis->formula;

            foreach ($this->formSlugs as $key => $v1) {
                array_push($variables, array_keys($v1)[0]);
                array_push($valores, array_values($v1)[0]);
            }

            $formula_replace = str_replace($variables, $valores, $formula_sustitucion);

            $string = $formula_replace;
            $sinExclamacion = preg_replace('/[¡!]/u', '', $string);

            $formula_final = $sinExclamacion;

            try {
                $result = eval('return '.$formula_final.';');
            } catch (\Throwable $th) {
                if ($th->getMessage() == 'Division by zero') {
                    $result = 0;
                } else {
                    $result = 0;
                }
            }

            if (isset($this->rangos_ind->valor_maximo) && isset($this->rangos_ind->valor_minimo)) {
                if($result > $this->rangos_ind->valor_maximo || $result < $this->rangos_ind->valor_minimo){
                    $this->alert('error', 'El resultado de la operación: '. $result .' no se encuentra dentro de los valores limite del indicador');

                    return false;
                }
            }
        }else{
            $result = $this->indicadoresSgsis->verde;
        }

        $evaluaciones->update([
            'evaluacion' => $this->evaluacion,
            'fecha' => $this->fecha,
            'resultado' => $result,
            'no_aplica' => $this->no_aplica ?? false,
            'justificacion' => $this->justificacion ?? null,
            'id_rango_indicadores_sgsi' => $this->rangos_ind->id ?? null,
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
        $this->no_aplica = false;
        $this->justificacion = null;

        $this->dispatch('contentChanged');

        $this->view = 'create';
    }

    public function cambio_aplica()
    {
        // dd($this->no_aplica);
        $this->render();
    }
}
