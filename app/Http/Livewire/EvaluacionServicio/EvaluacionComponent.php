<?php

namespace App\Http\Livewire\EvaluacionServicio;

use App\Models\Katbol\EvaluacionServicio;
use App\Models\Katbol\NivelesServicio;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class EvaluacionComponent extends Component
{
    use WithPagination, WithFileUploads, LivewireAlert;

    public $nivel_id;

    public $eval_id;

    public $fecha;

    public $evaluacion;

    public $promedio;

    public $resultado;

    public $view = 'create';

    public $evaluacion_props;

    public $meta_servicio;

    protected $rules = [
        'fecha' => 'required',
        'evaluacion' => 'required',
        'resultado' => 'required|numeric',
        // |lte:meta_servicio / se quito candado de meta
    ];

    public function render()
    {
        $obj_evaluacion = EvaluacionServicio::select('id', 'servicio_id', 'fecha', 'promedio', 'evaluacion_day')
            ->where('servicio_id', '=', $this->nivel_id);
        $total_evaluaciones = count($obj_evaluacion->get());

        $evaluacion_servicio = $obj_evaluacion->paginate(5);

        $nivel_servicio = NivelesServicio::select('nombre', 'metrica', 'unidad', 'meta')
            ->where('id', '=', $this->nivel_id)
            ->first();

            $promedio_evaluaciones = EvaluacionServicio::where('servicio_id', '=', $this->nivel_id)
            ->sum(DB::raw('CAST(promedio AS DECIMAL)'));

        return view('livewire.evaluacion-servicio.evaluacion-component', [
            'EvaluacionServicio' => $evaluacion_servicio,
            'nivel_servicio' => $nivel_servicio,
            'total_evaluaciones' => $total_evaluaciones,
            'promedio_evaluaciones' => $promedio_evaluaciones,
        ]);
    }

    public function mount($nivel_id)
    {
        $this->nivel_id = $nivel_id;
        $this->meta_servicio = NivelesServicio::select('nombre', 'metrica', 'unidad', 'meta')
            ->where('id', '=', $this->nivel_id)
            ->first()->meta;
    }

    public function store()
    {
        $last = EvaluacionServicio::latest('evaluacion_day', 'evaluacion')->where('servicio_id', '=', $this->nivel_id)->latest()->first();
        $date = Carbon::parse($this->fecha)->format('Y-m-d');

        if (is_null($last)) {
            $evaluacion = EvaluacionServicio::create([
                'servicio_id' => $this->nivel_id,
                'evaluacion' => 1,
                'evaluacion_day' => 1,
                'fecha' => $date,
                'promedio' => $this->resultado,
                'created_by' => auth()->user()->empleado->id,
                'updated_by' => auth()->user()->empleado->id,
            ]);
        } else {
            $evaluacion = EvaluacionServicio::create([
                'servicio_id' => $this->nivel_id,
                'evaluacion' => $last->evaluacion,
                'evaluacion_day' => $last->evaluacion_day + 1,
                'fecha' => $date,
                'promedio' => $this->resultado,
                'created_by' => auth()->user()->empleado->id,
                'updated_by' => auth()->user()->empleado->id,
            ]);
        }

        $this->dispatchBrowserEvent('contentChanged');
        $this->default();

        $this->alert('success', 'Registro añadido!');
    }

    public function edit($id)
    {
        //dd("edit");
        $evaluacion = EvaluacionServicio::find($id);
        $this->eval_id = $evaluacion->id;
        $this->nivel_id = $evaluacion->servicio_id;
        $this->fecha = $evaluacion->fecha;
        $this->evaluacion = $evaluacion->evaluacion;
        $this->resultado = $evaluacion->promedio;

        $this->evaluacion_props = [
            'fecha' => $this->fecha,
            'evaluacion' => $this->evaluacion,
            'meta' => intval($this->meta_servicio),
        ];
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'edit';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        //dd("test");

        //$this->validate();

        if (! is_null($this->eval_id)) {
            $evalservicio = EvaluacionServicio::find($this->eval_id);

            $evalservicio->update([
                'fecha' => date('Y-m-d', strtotime($this->fecha)),
                'evaluacion' => $this->evaluacion,
                'promedio' => $this->resultado,
            ]);

            $this->default();
            //$this->dispatchBrowserEvent('contentChanged');
            $this->alert('success', '¡Registro actualizado!');
        } else {
            $this->alert('error', '¡No has seleccionado ninguna evaluación!, presiona editar en el registro que desees modificar');
        }
    }

    public function destroy($id)
    {
        EvaluacionServicio::destroy($id);
        $this->alert('success', 'Registro eliminado!');
    }

    public function default()
    {
        $this->fecha = '';
        $this->evaluacion = '';
        $this->resultado = '';
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'create';
    }
}
