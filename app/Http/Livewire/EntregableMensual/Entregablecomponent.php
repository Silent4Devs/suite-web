<?php

namespace App\Http\Livewire\EntregableMensual;

use App\Functions\FormatearFecha;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\EntregableFile;
use App\Models\ContractManager\EntregaMensual;
use App\Models\ContractManager\Factura;
use App\Models\Organizacion;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Throwable;

class Entregablecomponent extends Component
{
    use LivewireAlert, WithFileUploads, WithPagination;

    public $contrato_id;

    public $iteration1;

    public $entregable_id;

    public $nombre_entregable;

    public $descripcion;

    public $plazo_entrega_inicio;

    public $plazo_entrega_termina;

    public $entrega_real;

    public $cumplimiento;

    public $observaciones;

    public $deductiva_penalizacion;

    public $aplica_deductiva;

    public $nota_credito;

    public $justificacion_deductiva_penalizacion;

    public $pdf;

    public $show_contrato; // En formulario de edit se está en vista de consulta entonces es true

    public $view = 'create';

    public $deductiva_factura_id;

    public $factura_id;

    public $facturas_entregables;

    public $search;

    public $sort = 'nombre_entregable';

    public $direction = 'desc';

    public $pagination = 3;

    public $organizacion;

    public $entregable;

    public $document_entregable;

    public $contrato;

    protected $listeners = [
        'getFacturas' => 'render',
        'triggerDeleteEntregable' => 'confirmDelete',
    ];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function render()
    {
        $entregable_mensual =
            EntregaMensual::where('contrato_id', $this->contrato_id)
                ->join('entregables_files', 'entregas_mensuales.id', '=', 'entregables_files.entregable_id')
                ->where(function ($query) {
                    $query->where('nombre_entregable', 'like', '%'.$this->search.'%')
                        ->orWhere('descripcion', 'like', '%'.$this->search.'%');
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);

        $this->dispatchBrowserEvent('paginador-entregables');

        $this->facturas_entregables = Factura::where('contrato_id', $this->contrato_id)->get();

        return view('livewire.entregable-mensual.entregablecomponent', [
            'entregamensuales' => $entregable_mensual,

        ]);
    }

    public function mount($contrato_id, $show_contrato)
    {
        $this->contrato_id = $contrato_id;
        $this->contrato = Contrato::find($contrato_id);
        $this->cumplimiento = true;
        $this->aplica_deductiva = false;
        $this->show_contrato = $show_contrato;
        $this->organizacion = Organizacion::first();
    }

    public function store()
    {
        $this->validate([
            'nombre_entregable' => 'required|max:255',
            'descripcion' => 'required',
            'plazo_entrega_inicio' => 'required|before_or_equal:plazo_entrega_termina',
            'plazo_entrega_termina' => 'required|after_or_equal:plazo_entrega_inicio',
            'entrega_real' => 'required|after_or_equal:plazo_entrega_inicio|before_or_equal:plazo_entrega_termina',
            'observaciones' => 'required',
            'entrega_real' => 'required',
            'factura_id' => 'required',
            'aplica_deductiva' => 'required',
            'deductiva_penalizacion' => 'numeric|max:100000000000',
            'nota_credito' => 'max:255',
        ]);

        $deductiva_penalizacion = preg_replace('([$,])', '', $this->deductiva_penalizacion);

        // $formatoFecha = new FormatearFecha;
        $fecha_inicial_formateada = $this->plazo_entrega_inicio;
        $fecha_final_formateada = $this->plazo_entrega_termina;
        $fecha_real_formateada = $this->entrega_real;
        //  dd(EntregaMensual::all()->where('contrato_id', $this->contrato_id)->count());
        $ultimo_numero_entregable = EntregaMensual::all()->where('contrato_id', $this->contrato_id)->count() > 0 ? EntregaMensual::select('no')->where('contrato_id', $this->contrato_id)->orderBy('id', 'desc')->first()->no : 0;
        $numero_entregable = ! is_null($ultimo_numero_entregable) ? $ultimo_numero_entregable + 1 : null;

        $entM = EntregaMensual::create([
            'contrato_id' => $this->contrato_id,
            'no' => $numero_entregable,
            'nombre_entregable' => $this->nombre_entregable,
            'descripcion' => $this->descripcion,
            'plazo_entrega_inicio' => $fecha_inicial_formateada,
            'plazo_entrega_termina' => $fecha_final_formateada,
            'entrega_real' => $fecha_real_formateada,
            'cumplimiento' => $this->cumplimiento,
            'observaciones' => $this->observaciones,
            'aplica_deductiva' => $this->aplica_deductiva,
            'deductiva_penalizacion' => $deductiva_penalizacion,
            'factura_id' => $this->factura_id,
            'deductiva_factura_id' => $this->deductiva_factura_id,
            'nota_credito' => $this->nota_credito,
            'justificacion_deductiva_penalizacion' => $this->justificacion_deductiva_penalizacion,
            'created_by' => User::getCurrentUser()->empleado->id,
            'updated_by' => User::getCurrentUser()->empleado->id,
        ]);

        $contrato = Contrato::select('id', 'no_contrato')->where('id', '=', $this->contrato_id)->first();
        if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato)) {
            Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato);
        }

        $entregableFile = EntregableFile::create([
            'entregable_id' => $entM->id,
        ]);

        if (isset($this->pdf)) {
            $entregables_filename = $this->pdf->getClientOriginalName();

            $entregableFile->update([
                'pdf' => $entregableFile->id.$entregables_filename,
            ]);
            $this->pdf->storeAs('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/entregables/pdf', $entregableFile->id.$entregables_filename);
        }
        // dd($entregables_filename);
        // if (isset($this->pdf)) {
        //     $this->pdfname = $this->pdf->getClientOriginalName();
        //     $this->pdf->storeAs('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/entregables/pdf', $date . $factura->id . $this->pdfname);

        //     $entregableFile->update([
        //         'pdf' => $date . $factura->id . $this->pdfname,
        //     ]);
        // }
        $this->emit('recargar-cumplimiento');
        $this->dispatchBrowserEvent('contentChanged');
        $this->default();
        $this->alert('success', 'Registro añadido!');
    }

    public function edit($id)
    {
        $entM = EntregaMensual::find($id);
        dd($id, EntregaMensual::find($id));
        if ($entM->id != null) {
            $this->entregable_file_edit = EntregableFile::where('entregable_id', $id)->first();
            $this->entregable = $entM;

            $document_entregable_pivot = EntregableFile::where('entregable_id', $id)->first();
        }

        // dd($document_entregable_pivot);
        // if (! is_null($document_entregable_pivot)) {
        //     $this->document_entregable = $document_entregable_pivot->pdf;
        // }

        try {
            $this->document_entregable = $document_entregable_pivot->pdf ? $document_entregable_pivot->pdf : '';
        } catch (Throwable $e) {
            $this->document_entregable = '';
        }

        // dd($this->document_entregable);

        // $formatoFecha = new FormatearFecha;
        $fecha_inicial_formateada = ! is_null($entM->plazo_entrega_inicio) ? $entM->plazo_entrega_inicio : null;
        $fecha_final_formateada = ! is_null($entM->plazo_entrega_termina) ? $entM->plazo_entrega_termina : null;
        $fecha_real_formateada = ! is_null($entM->entrega_real) ? $entM->entrega_real : null;
        $this->entregable_id = $entM->id;
        $this->nombre_entregable = $entM->nombre_entregable;
        $this->descripcion = $entM->descripcion;
        $this->plazo_entrega_inicio = $fecha_inicial_formateada;
        $this->plazo_entrega_termina = $fecha_final_formateada;
        $this->entrega_real = $fecha_real_formateada;
        $this->cumplimiento = is_null($entM->cumplimiento) ? false : ($entM->cumplimiento == 0 ? false : true);
        $this->observaciones = $entM->observaciones;
        $this->aplica_deductiva = is_null($entM->aplica_deductiva) ? false : ($entM->aplica_deductiva == 0 ? false : true);
        $this->deductiva_penalizacion = $entM->deductiva_penalizacion;
        $this->factura_id = $entM->factura_id;
        $this->deductiva_factura_id = $entM->deductiva_factura_id;
        $this->justificacion_deductiva_penalizacion = $entM->justificacion_deductiva_penalizacion;
        $this->nota_credito = $entM->nota_credito;
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'edit';
    }

    public function update()
    {
        // dd(request()->all());
        /*$this->validate([
            'plazo_entrega_inicio' => 'required',
            'observaciones' => 'required'
        ]);*/

        $this->validate([
            'nombre_entregable' => 'required',
            'descripcion' => 'required',
            'plazo_entrega_inicio' => 'required',
            'plazo_entrega_termina' => 'required',
            'entrega_real' => 'required',
            'observaciones' => 'required',
            // 'factura_id' =>'required',
            // 'aplica_deductiva' => 'required',
        ]);

        if ($this->pdf != null) {
            if (isset($this->pdf)) {
                $organizacion = Organizacion::first();
                $mines = str_replace('.', '', $organizacion->formatos);
                $tamaño_limite = ($organizacion->config_megas_permitido_docs) * 1024 * 1024;
                if ($this->pdf->getSize() >= $tamaño_limite) {
                    $this->alert('warning', 'El archivo file no debe pesar más de '.$organizacion->config_megas_permitido_docs.'M');

                    return 'error';
                }

                if ($this->pdf->getClientOriginalExtension() != 'pdf') {
                    $this->alert('warning', 'Formato no valido', [
                        'position' => 'top-end',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => 'El archivo debe ser formato PDF',
                        'confirmButtonText' => 'Aceptar',
                        'cancelButtonText' => 'Cancel',
                        'showCancelButton' => false,
                        'showConfirmButton' => true,
                    ]);

                    return 'error';
                }
            }
        }

        $entM = EntregaMensual::find($this->entregable_id);
        $deductiva_penalizacion = preg_replace('([$,])', '', $this->deductiva_penalizacion);

        // $formatoFecha = new FormatearFecha;
        $fecha_inicial_formateada = $this->plazo_entrega_inicio;
        $fecha_final_formateada = $this->plazo_entrega_termina;
        $fecha_real_formateada = $this->entrega_real;

        $entM->update([
            'contrato_id' => $this->contrato_id,
            'nombre_entregable' => $this->nombre_entregable,
            'descripcion' => $this->descripcion,
            'plazo_entrega_inicio' => $fecha_inicial_formateada,
            'plazo_entrega_termina' => $fecha_final_formateada,
            'entrega_real' => $fecha_real_formateada,
            'cumplimiento' => $this->cumplimiento,
            'observaciones' => $this->observaciones,
            'aplica_deductiva' => $this->aplica_deductiva,
            'deductiva_penalizacion' => $deductiva_penalizacion,
            'factura_id' => $this->factura_id,
            'deductiva_factura_id' => $this->deductiva_factura_id,
            'justificacion_deductiva_penalizacion' => $this->justificacion_deductiva_penalizacion,
            'nota_credito' => $this->nota_credito,

        ]);
        $entregableFile = EntregableFile::where('entregable_id', $entM->id);

        // dd($entregableFile->get());
        $contrato = Contrato::select('id', 'no_contrato')->where('id', '=', $this->contrato_id)->first();
        if (! Storage::exists('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato)) {
            Storage::makeDirectory('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato);
        }

        if ($this->pdf != null) {
            if (isset($this->pdf)) {
                $organizacion = Organizacion::first();
                $mines = str_replace('.', '', $organizacion->formatos);
                $tamaño_limite = ($organizacion->config_megas_permitido_docs) * 1024 * 1024;
                if ($this->pdf->getSize() >= $tamaño_limite) {
                    $this->alert('warning', 'El archivo file no debe pesar más de '.$organizacion->config_megas_permitido_docs.'M');

                    return 'error';
                }

                $entregables_filename = $this->pdf->getClientOriginalName();
                $this->pdf->storeAs('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/entregables/pdf', $entM->id.$entregables_filename);

                $entregableFile->update([
                    'pdf' => $entM->id.$entregables_filename,
                ]);
                //   dd($entregableFile);
            }
        }

        $this->emit('recargar-cumplimiento');
        $this->default();
        $this->dispatchBrowserEvent('contentChanged');
        $this->alert('success', 'Registro actualizado!');
    }

    public function confirmDelete($em_id)
    {
        $this->dispatchBrowserEvent('confirmDeleteEntregableEvent', ['em_id' => $em_id]);
    }

    public function destroy($id)
    {
        EntregaMensual::destroy($id);
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
        $this->nombre_entregable = '';
        $this->descripcion = '';
        $this->plazo_entrega_inicio = '';
        $this->plazo_entrega_termina = '';
        $this->entrega_real = '';
        $this->cumplimiento = true;
        $this->observaciones = '';
        $this->aplica_deductiva = false;
        $this->deductiva_penalizacion = '';
        $this->justificacion_deductiva_penalizacion = '';
        $this->factura_id = null;
        $this->deductiva_factura_id = null;
        $this->nota_credito = '';
        $this->iteration1++;
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'create';
    }

    public function exportPdf($id)
    {
        $pdf = EntregableFile::where('entregable_id', '=', $id)->latest()->first();
        if ($pdf == null) {
            $this->alert('info', 'No se encontro ningun PDF cargado!');
        } else {
            $contrato = Contrato::select('id', 'no_contrato')->where('id', '=', $this->contrato_id)->first();
            if (is_file(storage_path('app/public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/entregables/pdf/'.$pdf->pdf))) {
                return response()->download(storage_path('app/public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/entregables/pdf/'.$pdf->pdf));
            } else {
                $this->alert('info', 'No se encontro el archivo!');
            }
        }
    }
}
