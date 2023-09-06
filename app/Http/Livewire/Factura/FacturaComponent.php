<?php

namespace App\Http\Livewire\Factura;

use App\Functions\FacturasRevisionesData;
use App\Functions\FormatearFecha;
use App\Models\ContractManager\AmpliacionContrato;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\Factura;
use App\Models\ContractManager\FacturaFile;
use App\Models\ContractManager\RevisionesFactura;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class FacturaComponent extends Component
{
    use WithPagination, WithFileUploads, LivewireAlert;

    public $factura_id;

    public $concepto;

    public $conformidad;

    public $firma;

    public $n_cxl;

    public $contrato_id;

    public $no_factura;

    public $fecha_recepcion;

    public $no_revisiones;

    public $cumple;

    public $iteration;

    public $iteration1;

    public $hallazgos_comentarios;

    public $organizacion;

    public $fecha_liberacion;

    public $monto_factura;

    public $pdf;

    public $xml;

    public $estatus;

    public $pdfname;

    public $xmlname;

    public $asignado_id;

    public $show_contrato; // show_contrato variable para definir edit=false y show=true

    public $view = 'create';

    public $vista = 'revisionescreate';

    public $show_revisiones = false;

    public $search;

    public $sort = 'no_factura';

    public $direction = 'desc';

    public $pagination = 5;

    public $facturaRevision_id;

    public $consultaRevisiones;

    public $no_revision;

    public $usuarios;

    protected $listeners = [
        'triggerDeleteFactura' => 'confirmDelete',
    ];

    public function render()
    {
        $organizacion = Organizacion::first();
        $facturas = Factura::select('facturacion.id', 'no_factura', 'fecha_recepcion', 'fecha_liberacion', 'no_revisiones', 'cumple', 'monto_factura', 'estatus', 'n_cxl', 'firma', 'conformidad', 'facturas_files.pdf', 'facturas_files.xml')
            ->join('facturas_files', 'facturacion.id', '=', 'facturas_files.factura_id')
            ->where('no_factura', 'like', '%' . $this->search . '%')
            ->where('contrato_id', '=', $this->contrato_id)
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        $this->dispatchBrowserEvent('paginadorFacturas');
        //   ->orWhere('fecha_recepcion', 'like', '%' . $this->search . '%')
        // ->orWhere('fecha_liberacion', 'like', '%' . $this->search . '%')
        // ->orWhere('no_revisiones', 'like', '%' . $this->search . '%')

        return view('livewire.factura.factura-component', [
            // 'facturas' => Factura::orderBy('id', 'desc')->where('contrato_id', '=', $this->contrato_id)->get(),
            'facturas' => $facturas, 'organizacion' => $organizacion,
        ]);
    }

    public function hydrate()
    {
        $this->show_contrato;
        $this->cumple;
        $this->conformidad;
        $this->firma;
        $this->no_revisiones;
    }

    public function mount($contrato_id, $show_contrato, $contrato_total)
    {
        $this->contrato_id = $contrato_id;
        $this->show_contrato = $show_contrato;
        $this->cumple = true;
        $this->conformidad = true;
        $this->firma = true;
        $this->no_revisiones = 0;
        $ampliacion = AmpliacionContrato::where('contrato_id', $contrato_id)->first();
        $this->contrato_total = $ampliacion ? $ampliacion->monto_total_ampliado : $contrato_total;
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $contrato_model = Contrato::find($this->contrato_id);
        $this->fecha_inicio_contrato = $contrato_model->fecha_inicio;
        $this->fecha_fin_contrato = $contrato_model->fecha_fin;
        // dd($contrato_model);
        $this->monto_factura = $this->monto_factura == null ? '$0.00' : $this->monto_factura;
        // $this->validate([
        //     'no_factura' => ['required', 'regex:/^[\s\w-]*$/'],
        //     'fecha_recepcion' => 'required|after_or_equal:fecha_inicio_contrato',
        //     // 'no_revisiones' => 'required|numeric|min:0',
        //     'fecha_liberacion' => 'required|before_or_equal:fecha_fin_contrato',
        //     'monto_factura' => ['required', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/"],
        //     // 'estatus' => 'required',
        //     'concepto' => 'required',
        //     // 'hallazgos_comentarios' => 'nullable'
        // ], [
        //     'fecha_recepcion.after_or_equal' => 'La fecha de recepción no puede ser antes de la fecha inicio del contrato',
        //     'fecha_liberacion.before_or_equal' => 'La fecha de recepción no puede ser despues de la fecha fin del contrato',
        //     'monto_factura.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
        // ]);
        //dd($this);

        $monto_factura = null;
        if (isset($this->monto_factura)) {
            $monto_factura = str_replace('$', '', $this->monto_factura);
            $monto_factura = str_replace(',', '', $monto_factura);
        }

        $this->monto_total_facturas = Factura::select('facturacion.id', 'monto_factura', 'estatus')
            ->where('contrato_id', '=', $this->contrato_id)
            ->sum('monto_factura');

        $formatoFecha = new FormatearFecha;

        if ($this->fecha_recepcion) {
            $fecha_recepcion_formateada = $this->fecha_recepcion;
        }
        if ($this->fecha_liberacion) {
            $fecha_liberacion_formateada = $this->fecha_liberacion;
        }

        $validacion_totales = (float) $monto_factura + (float) $this->monto_total_facturas;

        if ($validacion_totales > (float) $this->contrato_total) {
            $this->alert('warning', 'Monto superado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'El monto de factura supera el monto de contrato',
                'confirmButtonText' => 'Aceptar',
                'cancelButtonText' => 'Cancel',
                'showCancelButton' => false,
                'showConfirmButton' => true,
            ]);
        } elseif ($validacion_totales > (float) $this->contrato_total) {
            $this->alert('warning', 'Monto superado', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  'El monto de factura supera el monto de proyecto',
                'confirmButtonText' =>  'Aceptar',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  true,
            ]);
        } else {
            // $formatoFecha = new FormatearFecha;
            if ($this->fecha_recepcion) {
                $fecha_recepcion_formateada = $this->fecha_recepcion;
            }
            if ($this->fecha_liberacion) {
                $fecha_liberacion_formateada = $this->fecha_liberacion;
            }

            $factura = Factura::create([
                'contrato_id' => $this->contrato_id,
                'no_factura' => $this->no_factura,
                'concepto' => $this->concepto,
                'fecha_recepcion' => $this->fecha_recepcion ? $fecha_recepcion_formateada : null,
                'no_revisiones' => $this->no_revisiones,
                'cumple' => $this->cumple,
                'n_cxl' => $this->n_cxl,
                'firma' => $this->firma,
                'conformidad' => $this->conformidad,
                'fecha_liberacion' => $this->fecha_liberacion ? $fecha_liberacion_formateada : null,
                'monto_factura' => $monto_factura,
                'hallazgos_comentarios' => $this->hallazgos_comentarios,
                'estatus' => $this->estatus,
                // 'created_by' => auth()->user()->empleado->id,
                // 'updated_by' => auth()->user()->empleado->id,
            ]);

            $date = Carbon::now();
            $date = $date->format('d-m-Y');

            $facturaFile = FacturaFile::create([
                'factura_id' => $factura->id,
                // 'created_by' => auth()->user()->empleado->id,
                // 'updated_by' => auth()->user()->empleado->id,
            ]);

            //### Facturas reestructuracion ####

            $contrato = Contrato::select('id', 'no_contrato')->where('id', '=', $this->contrato_id)->first();
            if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato)) {
                Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato);
            }

            if (isset($this->xml)) {
                $this->xmlname = $this->xml->getClientOriginalName();
                $this->xml->storeAs('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/xml', $date . $factura->id . $this->xmlname);

                $facturaFile->update([
                    'xml' => $date . $factura->id . $this->xmlname,
                ]);
            }

            if (isset($this->pdf)) {
                $this->pdfname = $this->pdf->getClientOriginalName();
                $this->pdf->storeAs('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/pdf', $date . $factura->id . $this->pdfname);

                $facturaFile->update([
                    'pdf' => $date . $factura->id . $this->pdfname,
                ]);
            }

            $this->emit('recargar-cumplimiento');
            //$this->dispatchBrowserEvent('contentChanged');
            $this->default();
            $this->dispatchBrowserEvent('cumple');
            $this->dispatchBrowserEvent('firma');
            $this->dispatchBrowserEvent('conformidad');
            $this->alert('success', 'Registro añadido!');
        } //termina else
    }

    public function edit($id)
    {
        $factura = Factura::find($id);

        // $formatoFecha = new FormatearFecha;

        $fecha_recepcion_formateada = $factura->fecha_recepcion;
        $fecha_liberacion_formateada = $factura->fecha_liberacion;

        $this->factura_id = $factura->id;
        $this->contrato_id = $factura->contrato_id;
        $this->no_factura = $factura->no_factura;
        $this->concepto = $factura->concepto;
        $this->fecha_recepcion = $fecha_recepcion_formateada;
        $this->no_revisiones = $factura->no_revisiones;
        $this->cumple = $factura->cumple;
        $this->n_cxl = $factura->n_cxl;
        $this->conformidad = $factura->conformidad;
        $this->firma = $factura->firma;
        $this->fecha_liberacion = $fecha_liberacion_formateada;
        $this->monto_factura = $factura->monto_factura;
        // $this->hallazgos_comentarios = $factura->hallazgos_comentarios;
        // $this->estatus = $factura->estatus;
        $this->dispatchBrowserEvent('contentChanged');

        $this->view = 'edit';
    }

    public function update()
    {
        $contrato_model = Contrato::find($this->contrato_id);
        $this->fecha_inicio_contrato = $contrato_model->fecha_inicio;
        $this->fecha_fin_contrato = $contrato_model->fecha_fin;

        $this->monto_factura = str_contains($this->monto_factura, '$') ? $this->monto_factura : '$' . $this->monto_factura;

        $this->validate([
            'no_factura' => ['required', 'regex:/^[\s\w-]*$/'],
            // 'fecha_recepcion' => 'required|after_or_equal:fecha_inicio_contrato|before_or_equal:fecha_fin_contrato',
            // 'fecha_liberacion' => 'required|before_or_equal:fecha_fin_contrato|after_or_equal:fecha_inicio_contrato',
            // 'no_revisiones' => 'required|numeric|min:0',
            'monto_factura' => ['required', "regex:/(^[$](?!0+\\\.00)(?=.{1,14}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.\d{1,2})?)/"],
            // 'estatus' => 'required',
            'concepto' => 'required',
            // 'hallazgos_comentarios' => 'nullable',
        ], [
            'fecha_recepcion.after_or_equal' => 'La fecha de recepción no puede ser antes de la fecha inicio del contrato',
            'fecha_liberacion.before_or_equal' => 'La fecha de recepción no puede ser despues de la fecha fin del contrato',
            'monto_factura.regex' => 'El monto total debe ser menor a 99,999,999,999.99',
        ]);
        $id_factura = $this->factura_id;
        $monto_factura = null;
        if (isset($this->monto_factura)) {
            $monto_factura = str_replace('$', '', $this->monto_factura);
            $monto_factura = str_replace(',', '', $monto_factura);
        }

        $factura = Factura::find($id_factura);

        $this->monto_total_facturas = Factura::select('facturacion.id', 'monto_factura', 'estatus')
            ->where('contrato_id', '=', $this->contrato_id)
            ->sum('monto_factura');

        $this->monto_total_facturas = (float) $this->monto_total_facturas - (float) $factura->monto_factura;

        // $resta_valor_actual = (float) $this->monto_total_facturas - (float) $factura->monto_factura;

        // $formatoFecha = new FormatearFecha;

        $fecha_recepcion_formateada = $factura->fecha_recepcion;
        $fecha_liberacion_formateada = $factura->fecha_liberacion;

        // dd($resta_valor_actual, $this->monto_total_facturas, $factura->monto_factura, $validacion_totales);
        $validacion_totales = (float) $monto_factura + (float) $this->monto_total_facturas;
        if ($validacion_totales > (float) $this->contrato_total) {
            $this->alert('warning', 'Monto superado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' =>  'Se requiere registrar monto de proyecto para continuar',
                'confirmButtonText' => 'Aceptar',
                'cancelButtonText' => 'Cancel',
                'showCancelButton' => false,
                'showConfirmButton' => true,
            ]);
        } elseif ($validacion_totales > (float) $this->contrato_total) {
            $this->alert('warning', 'Monto superado', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  'El monto de factura supera el monto de proyecto',
                'confirmButtonText' =>  'Aceptar',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  true,
            ]);
        } else {
            // $formatoFecha = new FormatearFecha;

            $fecha_recepcion_formateada = $this->fecha_recepcion;
            $fecha_liberacion_formateada = $this->fecha_liberacion;

            //Se genera el log
            //DB::select('call actualiza_user(?, ?, ?)',array('facturacion', auth()->id(), $id_factura));

            $factura->update([
                'contrato_id' => $this->contrato_id,
                'no_factura' => $this->no_factura,
                'concepto' => $this->concepto,
                'fecha_recepcion' => $fecha_recepcion_formateada,
                'no_revisiones' => $this->no_revisiones,
                'cumple' => $this->cumple,
                'fecha_liberacion' => $fecha_liberacion_formateada,
                'monto_factura' => $monto_factura,
                // 'hallazgos_comentarios' => $this->hallazgos_comentarios,
                // 'estatus' => $this->estatus,
                'created_by' => auth()->id(),
            ]);

            $date = Carbon::now();
            $date = $date->format('d-m-Y');

            $facturaFile = FacturaFile::find($factura->id);

            //### Facturas GESTION ARCHIVOS ####
            $contrato = Contrato::select('id', 'no_contrato')->where('id', '=', $this->contrato_id)->first();
            if (!Storage::exists('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato)) {
                Storage::makeDirectory('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato);
            }

            if (isset($this->xml)) {
                $this->xmlname = $this->xml->getClientOriginalName();
                $this->xml->storeAs('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/xml', $date . $factura->id . $this->xmlname);

                $facturaFile->update([
                    'xml' => $date . $factura->id . $this->xmlname,
                ]);
            }

            if (isset($this->pdf)) {
                $this->pdfname = $this->pdf->getClientOriginalName();
                $this->pdf->storeAs('public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/pdf', $date . $factura->id . $this->pdfname);

                $facturaFile->update([
                    'pdf' => $date . $factura->id . $this->pdfname,
                ]);
            }

            $this->emit('recargar-cumplimiento');
            //$this->dispatchBrowserEvent('contentChanged');
            $this->default();
            $this->dispatchBrowserEvent('cumple');
            $this->dispatchBrowserEvent('firma');
            $this->dispatchBrowserEvent('conformidad');
            $this->alert('success', 'Registro añadido!');
        } //terminar else
    }

    public function confirmDelete($factura_id)
    {
        $this->dispatchBrowserEvent('confirmDeleteEventFactura', ['factura_id' => $factura_id]);
    }

    public function destroy($id)
    {
        // dd($request);
        Factura::destroy($id);

        //generacion de log
        //DB::select('call actualiza_user(?, ?, ?)', array('facturacion', auth()->id(), $id));
        $this->emit('recargar-cumplimiento');
        $this->alert('success', 'Registro eliminado!');
    }

    public function exportPdf($id)
    {
        $pdf = FacturaFile::where('factura_id', '=', $id)->first();
        if ($pdf == null) {
            $this->alert('info', 'No se encontro ningun PDF cargado!');
        } else {
            $contrato = Contrato::select('id', 'no_contrato')->where('id', '=', $this->contrato_id)->first();
            if (is_file(storage_path('app/public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/pdf/' . $pdf->pdf))) {
                return response()->download(storage_path('app/public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/pdf/' . $pdf->pdf));
            } else {
                $this->alert('info', 'No se encontro el archivo!');
            }
        }
    }

    public function revisionesfunction($facturaRevision_id)
    {
        $this->usuarios = Empleado::getaltaAll();
        $this->facturaRevision_id = $facturaRevision_id;

        $no_revision = RevisionesFactura::where('id_facturacion', $this->facturaRevision_id)->count();
        if ($no_revision) {
            $this->no_revision = $no_revision + 1;
        } else {
            $this->no_revision = 1;
        }
        $consultaRevisiones = RevisionesFactura::where('id_facturacion', $this->facturaRevision_id)->get();

        // $consultaRevisiones = RevisionesFactura::get();
        $this->show_revisiones = !$this->show_revisiones;
        $this->consultaRevisiones = $consultaRevisiones;
    }

    public function revisiones()
    {
        // $dataEnt = new FacturasRevisionesData();
        $facturaRevision_id = $this->facturaRevision_id;
        $revisiones_create = RevisionesFactura::create([
            'no_revisiones' => $this->no_revision,
            'cumple' => $this->cumple,
            'estatus' => $this->estatus,
            'observaciones' => $this->hallazgos_comentarios,
            'id_facturacion' => $facturaRevision_id,
            'asignado_id' => $this->asignado_id,
        ]);
        $this->revisionFacturaCreate($facturaRevision_id);
        $this->default();
        $this->revisionesfunction($facturaRevision_id);
        $this->alert('success', 'Registro añadido!');
    }

    public function revisionDelete($id)
    {
        $this->revisionFacturaDelete($id);
        RevisionesFactura::destroy($id);

        $this->revisionesfunction($this->facturaRevision_id);

        $this->alert('success', 'Registro eliminado!');
    }

    public function exportXml($id)
    {
        $xml = FacturaFile::where('factura_id', '=', $id)->first();
        if ($xml == null) {
            $this->alert('info', 'No se encontro ningun xml cargado!');
        } else {
            $contrato = Contrato::select('id', 'no_contrato')->where('id', '=', $this->contrato_id)->first();

            if (is_file(storage_path('app/public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/xml/' . $xml->xml))) {
                return response()->download(storage_path('app/public/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/facturas/xml/' . $xml->xml));
            } else {
                $this->alert('info', 'No se encontro el archivo!');
            }
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
        $this->no_factura = '';
        $this->fecha_recepcion = '';
        $this->no_revisiones = 0;
        $this->cumple = true;
        $this->conformidad = true;
        $this->firma = true;
        $this->n_cxl = '0';
        $this->fecha_liberacion = '';
        $this->monto_factura = '';
        $this->concepto = '';
        $this->estatus = '';
        $this->hallazgos_comentarios = '';
        $this->pdf = null;
        $this->iteration++;
        $this->xml = null;
        $this->iteration1++;
        $this->dispatchBrowserEvent('contentChanged');

        $this->no_revisiones = '';
        $this->estatus = '';
        $this->hallazgos_comentarios = '';

        $this->view = 'create';
    }

    //funcion encargada de actualizar el # de revisiones al crear una revision de factura
    public function revisionFacturaCreate($facturaRevision_id)
    {
        $revision_factura = Factura::find($facturaRevision_id);
        $data = RevisionesFactura::where('id_facturacion', '=', $facturaRevision_id)->count('no_revisiones');
        $revision_factura->no_revisiones = $data;
        $revision_factura->save();
    }

    //funcion encargada de actualizar el # de revisiones al eliminar una revision de factura
    public function revisionFacturaDelete($id)
    {
        $revision = RevisionesFactura::where('id', '=', $id)->get();
        $facturacion_id = RevisionesFactura::find($revision[0]['id']);
        $revision_factura = Factura::find($facturacion_id->id_facturacion);
        $data = RevisionesFactura::where('id_facturacion', '=', $facturacion_id->id_facturacion)->where('id', '!=', $id)->count('no_revisiones');
        if ($data == null) {
            $revision_factura->no_revisiones = 0;
        } else {
            $revision_factura->no_revisiones = $data;
        }
        $revision_factura->save();
    }
}
