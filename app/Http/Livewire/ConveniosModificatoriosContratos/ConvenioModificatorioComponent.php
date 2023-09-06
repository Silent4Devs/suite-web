<?php

namespace App\Http\Livewire\ConveniosModificatoriosContratos;

use App\Functions\FormatearFecha;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\ConveniosModificatorios;
use App\Models\ContractManager\ConveniosModificatoriosFile;
use App\Models\Organizacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ConvenioModificatorioComponent extends Component
{
    use LivewireAlert;
    use WithPagination, WithFileUploads;

    public $contrato_id;

    public $convenio_id;

    public $no_convenio;

    public $fecha;

    public $descripcion;

    public $iteration;

    public $deductiva_penalizacion;

    public $convenios_file;

    public $show_contrato; // En formulario de edit se está en vista de consulta entonces es true

    public $view = 'create';

    public $search;

    public $sort = 'no_convenio';

    public $direction = 'desc';

    public $pagination = 5;

    public function mount($contrato_id, $show_contrato)
    {
        $this->contrato_id = $contrato_id;
        $this->show_contrato = $show_contrato;
    }

    public function render()
    {
        $organizacion = Organizacion::first();
        $convenios = ConveniosModificatorios::with('contrato')->where('contrato_id', '=', $this->contrato_id)->get();

        $convenios = ConveniosModificatorios::select('id', 'no_convenio', 'fecha', 'descripcion')
            ->where('contrato_id', '=', $this->contrato_id)
            ->where(function ($query) {
                $query->where('no_convenio', 'like', '%'.$this->search.'%')
                    ->orWhere('descripcion', 'like', '%'.$this->search.'%')
                    ->orWhere('id', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        $this->dispatchBrowserEvent('paginadorConvenios');

        return view('livewire.convenios-modificatorios-contratos.convenio-modificatorio-component', [
            'convenio' => $convenios, 'organizacion' => $organizacion,
        ]);
    }

    public function store()
    {
        $this->validate([
            'fecha' => 'required',
            'no_convenio' => 'required',
        ]);

        $contrato = Contrato::find($this->contrato_id);

        $convenios = ConveniosModificatorios::where('contrato_id', '=', $this->contrato_id)->get();
        // if ($contrato->convenios) {
        //Ampliación
        // $convenio_modificatorio = ConveniosModificatorios::find($this->convenio_id);

        $formatoFecha = new FormatearFecha;

        $fecha_formateada = $this->fecha;

        $convenios = ConveniosModificatorios::create([
            'contrato_id' => $this->contrato_id,
            'no_convenio' => $this->no_convenio,
            'fecha' => $fecha_formateada,
            'descripcion' => $this->descripcion,
            'created_by' => auth()->user()->empleado->id,
            'updated_by' => auth()->user()->empleado->id,
        ]);

        $convenioFile = ConveniosModificatoriosFile::create([
            'convenios_modificatorios_id' => $convenios->id,
        ]);

        if (isset($this->convenios_file)) {
            $convenios_filename = $this->convenios_file->getClientOriginalName();

            $convenioFile->update([
                'convenios_file' => $convenios->id.$convenios_filename,
            ]);
            $this->convenios_file->storeAs('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/convenios/pdf', $convenios->id.$convenios_filename);
        }

        // $this->default();
        // $this->alert('sucess', 'Registro actualizado!');

        // } else {
        $this->default();
        $this->dispatchBrowserEvent('contentChanged');
        $this->alert('success', 'Registro actualizado!');
        // }
    }

    public function edit($id)
    {
        $convenios = ConveniosModificatorios::find($id);
        $formatoFecha = new FormatearFecha;

        $fecha_formateada = $formatoFecha->formatearFecha($convenios->fecha, 'Y-m-d', 'd-m-Y');

        $this->convenio_id = $convenios->id;
        $this->contrato_id = $convenios->contrato_id;
        $this->no_convenio = $convenios->no_convenio;
        $this->fecha = $fecha_formateada;
        $this->descripcion = $convenios->descripcion;
        $this->view = 'edit';
        // dd($this->fecha);
    }

    public function show($id)
    {
        $convenios = ConveniosModificatorios::find($id);

        $formatoFecha = new FormatearFecha;
        $fecha_formateada = $formatoFecha->formatearFecha($convenios->fecha, 'Y-m-d', 'd-m-Y');

        $this->convenio_id = $convenios->id;
        $this->contrato_id = $convenios->contrato_id;
        $this->no_convenio = $convenios->no_convenio;
        $this->fecha = $fecha_formateada;
        $this->descripcion = $convenios->descripcion;
        $this->file_convenio = $convenios->file_convenio;
        $this->view = 'show';
    }

    public function update()
    {
        $convenios = ConveniosModificatorios::find($this->convenio_id);
        // if ($contrato->convenios ) {
        //ampliacion
        // $formatoFecha = new FormatearFecha;
        // $fecha_formateada = $formatoFecha->formatearFecha($convenios->fecha, 'Y-m-d', 'd-m-Y');

        $formatoFecha = new FormatearFecha;
        $fecha_formateada = $formatoFecha->formatearFecha($this->fecha, 'd-m-Y', 'Y-m-d');

        $convenios->update([
            'contrato_id' => $this->contrato_id,
            'no_convenio' => $this->no_convenio,
            'fecha' => $fecha_formateada,
            'descripcion' => $this->descripcion,
        ]);
        // dd($convenios);

        $convenioFile = ConveniosModificatoriosFile::find($convenios->id);
        $date = Carbon::now();
        $date = $date->format('d-m-Y');

        $contrato = Contrato::select('id', 'no_contrato')->where('id', '=', $this->contrato_id)->first();
        if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato)) {
            Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato);
        }

        if (isset($this->convenios_file)) {
            $convenios_filename = $this->convenios_file->getClientOriginalName();

            $convenioFile->update([
                'convenios_file' => $date.$convenios->id.$convenios_filename,
            ]);

            $this->convenios_file->storeAs('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/convenios/pdf', $date.$convenios->id.$convenios_filename);
        }
        // dd($convenioFile);
        $this->default();
        $this->dispatchBrowserEvent('contentChanged');
        $this->alert('success', 'Registro actualizado!');

        // } else {
        //     $this->default();
        //     $this->alert('error', 'Convenio no autorizado!');
        // }
    }

    public function destroy($id)
    {
        ConveniosModificatorios::destroy($id);
        $this->alert('success', 'Registro eliminado!');
    }

    public function exportConvenios($id)
    {
        $convenios_file = ConveniosModificatoriosFile::find($id);
        if ($convenios_file->convenios_file == null) {
            $this->alert('info', 'No se encontro ningun PDF cargado!');
        } else {
            //return Storage::disk('pdf')->download($pdf->pdf);
            $contrato = Contrato::select('id', 'no_contrato')->where('id', '=', $this->contrato_id)->first();

            return response()->download(storage_path('app/public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/convenios/pdf/'.$convenios_file->convenios_file));
        }
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
        $this->no_convenio = '';
        $this->fecha = '';
        $this->descripcion = '';
        $this->convenios_file = null;
        $this->iteration++;
        $this->dispatchBrowserEvent('contentChanged');

        $this->view = 'create';
    }
}
