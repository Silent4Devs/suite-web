<?php

namespace App\Http\Livewire\NivelesServicio;

use App\Functions\EvaluacionServiciosData;
use App\Functions\FormatearFecha;
use App\Models\ContractManager\EvaluacionServicio;
use App\Models\ContractManager\NivelesServicio;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class NivelesComponent extends Component
{
    use WithPagination, WithFileUploads, LivewireAlert;

    public $contrato_id;

    public $nivel_id;

    public $nombre;

    public $periodo_evaluacion;

    public $area;

    public $descripcion;

    public $metrica;

    public $unidad;

    public $info_consulta;

    public $meta;

    public $revisiones;

    public $show_contrato; // En formulario de edit se está en vista de consulta entonces es true

    public $view = 'create';

    public $search;

    public $sort = 'id';

    public $direction = 'desc';

    public $pagination = 5;

    protected $listeners = [
        'triggerDeleteNiveles' => 'confirmDelete',
    ];

    public function render()
    {
        $niveles_servicio = NivelesServicio::select('id', 'nombre', 'metrica', 'unidad', 'info_consulta', 'meta', 'periodo_evaluacion', 'revisiones', 'area', 'descripcion')
            ->where('contrato_id', '=', $this->contrato_id)
            ->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                    ->orWhere('id', 'like', '%' . $this->search . '%')
                    ->orWhere('area', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        $this->dispatchBrowserEvent('paginador-niveles');

        return view('livewire.niveles-servicio.niveles-component', [
            'nivelesServicio' => $niveles_servicio,
        ]);
    }

    public function mount($contrato_id, $show_contrato)
    {
        $this->contrato_id = $contrato_id;
        $this->show_contrato = $show_contrato;
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|max:255',
            'metrica' => 'required|max:255',
            'meta' => 'required|max:100000000000',
            'unidad' => 'required|max:255',
            'info_consulta' => 'required',
            'periodo_evaluacion' => 'required',
            'revisiones' => 'required|numeric|max:100000000000',
            'area' => 'required|max:255',
            'descripcion' => 'required',
        ]);
        //dd(request()->all());
        // $formatoFecha = new FormatearFecha;
        // $fecha_compromiso_formateada = $formatoFecha->formatearFecha($this->fecha_compromiso, 'd-m-Y', 'Y-m-d');
        // $fecha_real_formateada = $formatoFecha->formatearFecha($this->fecha_real, 'd-m-Y', 'Y-m-d');

        $nivelesservicio = NivelesServicio::create([
            'contrato_id' => $this->contrato_id,
            'nombre' => $this->nombre,
            'metrica' => $this->metrica,
            'unidad' => $this->unidad,
            'meta' => $this->meta,
            'info_consulta' => $this->info_consulta,
            'periodo_evaluacion' => $this->periodo_evaluacion,
            'revisiones' => $this->revisiones,
            'area' => $this->area,
            'descripcion' => $this->descripcion,
            'created_by' => auth()->user()->empleado->id,
            'updated_by' => auth()->user()->empleado->id,
        ]);

        $this->evaluacion($nivelesservicio->id, $nivelesservicio->periodo_evaluacion, $nivelesservicio->revisiones, $nivelesservicio->nombre, $nivelesservicio->metrica, $nivelesservicio->unidad);
        //$this->dispatchBrowserEvent('contentChanged');
        $this->emit('recargar-cumplimiento');
        $this->default();

        $this->alert('success', 'Registro añadido!');
    }

    public function edit($id)
    {
        $nivelesservicio = NivelesServicio::find($id);

        $this->nivel_id = $nivelesservicio->id;
        $this->nombre = $nivelesservicio->nombre;
        $this->metrica = $nivelesservicio->metrica;
        $this->unidad = $nivelesservicio->unidad;
        $this->info_consulta = $nivelesservicio->info_consulta;
        $this->meta = $nivelesservicio->meta;
        $this->periodo_evaluacion = $nivelesservicio->periodo_evaluacion;
        $this->revisiones = $nivelesservicio->revisiones;
        $this->area = $nivelesservicio->area;
        $this->descripcion = $nivelesservicio->descripcion;
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'edit';
    }

    public function show($id)
    {
        $nivelesservicio = NivelesServicio::find($id);

        // $formatoFecha = new FormatearFecha;
        // $fecha_compromiso_formateada = $formatoFecha->formatearFecha($nivelesservicio->fecha_compromiso, 'Y-m-d', 'd-m-Y');
        // $fecha_real_formateada = $formatoFecha->formatearFecha($nivelesservicio->fecha_real, 'Y-m-d', 'd-m-Y');

        $this->nivel_id = $nivelesservicio->id;
        $this->nombre = $nivelesservicio->nombre;
        $this->metrica = $nivelesservicio->metrica;
        $this->unidad = $nivelesservicio->unidad;
        $this->info_consulta = $nivelesservicio->info_consulta;
        $this->meta = $nivelesservicio->meta;
        $this->periodo_evaluacion = $nivelesservicio->periodo_evaluacion;
        $this->revisiones = $nivelesservicio->revisiones;
        $this->area = $nivelesservicio->area;
        $this->descripcion = $nivelesservicio->descripcion;
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'show';
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
            'metrica' => 'required',
            'meta' => 'required',
            'unidad' => 'required',
            'info_consulta' => 'required',
            'periodo_evaluacion' => 'required',
            'revisiones' => 'required',
            'area' => 'required',
            'descripcion' => 'required',
        ]);
        //$this->updateEvaluacion($this->nivel_id, $this->periodo_evaluacion, $this->revisiones, $this->nombre, $this->metrica, $this->unidad);
        $nivelesservicio = NivelesServicio::find($this->nivel_id);

        $nivelesservicio->update([
            'nombre' => $this->nombre,
            'metrica' => $this->metrica,
            'unidad' => $this->unidad,
            'meta' => $this->meta,
            'info_consulta' => $this->info_consulta,
            'periodo_evaluacion' => $this->periodo_evaluacion,
            'revisiones' => $this->revisiones,
            'area' => $this->area,
            'descripcion' => $this->descripcion,
        ]);
        $this->emit('recargar-cumplimiento');
        $this->default();
        //$this->dispatchBrowserEvent('contentChanged');
        $this->alert('success', 'Registro actualizado!');
    }

    public function confirmDelete($tem_id)
    {
        $this->dispatchBrowserEvent('confirmDeleteNivelesEvent', ['tem_id' => $tem_id]);
    }

    public function destroy($id)
    {
        NivelesServicio::destroy($id);
        $this->emit('recargar-cumplimiento');
        $this->alert('success', 'Registro eliminado!');
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function default()
    {
        $this->nombre = '';
        $this->metrica = '';
        $this->meta = '';
        $this->unidad = '';
        $this->info_consulta = '';
        $this->periodo_evaluacion = '';
        $this->revisiones = '';
        $this->area = '';
        $this->descripcion = '';
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'create';
    }

    public function evaluacion($id_evaluacion, $periodo_evaluacion, $revisiones, $nombre, $metrica, $unidad)
    {
        //Conteo fechas por calendario
        /*$dataEnt = new EvaluacionServiciosData();
        $res = $dataEnt->TraerDatos($id_evaluacion, $periodo_evaluacion, $revisiones, $nombre, $metrica, $unidad);
        EvaluacionServicio::insert($res);*/
        $dataEnt = new EvaluacionServiciosData();
        $res = $dataEnt->conteoFechas($id_evaluacion, $periodo_evaluacion, $revisiones);
        EvaluacionServicio::insert($res);
    }

    public function updateEvaluacion($id_evaluacion, $periodo_evaluacion, $revisiones, $nombre, $metrica, $unidad)
    {
        $dataEnt = new EvaluacionServiciosData();
        $res = $dataEnt->ActualizarDatos($id_evaluacion, $periodo_evaluacion, $revisiones, $nombre, $metrica, $unidad);
        //EvaluacionServicio::insert($res);
    }
}
