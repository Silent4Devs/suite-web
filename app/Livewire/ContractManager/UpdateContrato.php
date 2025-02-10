<?php

namespace App\Livewire\ContractManager;

use App\Models\Area;
use App\Models\User;
use Livewire\Component;
use App\Models\FirmaModule;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use App\Rules\NumeroContrato;
use App\Models\TimesheetCliente;
use App\Functions\FormatearFecha;
use App\Models\TimesheetProyecto;
use App\Models\ConvergenciaContratos;
use App\Models\AprobadorFirmaContrato;
use Illuminate\Support\Facades\Storage;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\Sucursal;
use App\Models\AprobadorFirmaContratoHistorico;
use App\Models\ContractManager\DolaresContrato;
use App\Models\ContractManager\ConveniosModificatorios;
class UpdateContrato extends Component
{
    public $contrato;
    public $contrato_id;
    public $show_contrato = false;
    public $form = [];
    public $firmado = false;
    public $firmar = false;
    public $firma = null;
    public $convenios;
    public $razones_sociales;
    public function mount($contrato_id)
    {
        $this->$contrato_id = $contrato_id;
    }

    public function update()
    {
        session()->put('tipo_cambio', $this->form['tipo_cambio']);

        $validatedData = $this->validate([
            'form.no_contrato' => ['required', new NumeroContrato($this->contrato->id)],
            'form.no_proyecto' => 'required',
            'form.nombre_servicio' => 'required|max:500',
            'form.tipo_contrato' => 'required',
            'form.proveedor_id' => 'required',
            'form.objetivo' => 'required|max:500',
            'form.estatus' => 'required|max:255',
            'form.cargo_administrador' => 'max:250',
            'form.area_administrador' => 'max:250',
            'form.puesto' => 'max:250',
            'form.area' => 'max:250',
            'form.fase' => 'required',
            'form.vigencia_contrato' => 'required|max:255',
            'form.fecha_inicio' => 'required|date',
            'form.fecha_fin' => 'required|date|after:form.fecha_inicio',
            'form.area_id' => 'required',
            'form.fecha_firma' => 'required|before_or_equal:form.fecha_fin',
            'form.no_pagos' => 'required|numeric|lte:500000',
            'form.tipo_cambio' => 'required',
            'form.monto_pago' => 'required|numeric|min:0|max:99999999999.99',
            'form.minimo' => 'nullable|numeric|max:99999999999.99',
            'form.maximo' => 'nullable|numeric|max:99999999999.99',
            'form.monto_dolares' => 'nullable|numeric|max:99999999999.99',
            'form.maximo_dolares' => 'nullable|numeric|max:99999999999.99',
            'form.minimo_dolares' => 'nullable|numeric|max:99999999999.99',
        ]);

        foreach (['monto_pago', 'minimo', 'maximo', 'monto_dolares', 'maximo_dolares', 'minimo_dolares'] as $field) {
            if (!empty($this->form[$field])) {
                $this->form[$field] = str_replace(["$", ","], "", $this->form[$field]);
            }
        }

        $areas = Area::pluck('id')->toArray();
        $this->form['area_id'] = in_array($this->form['area_id'], $areas) ? $this->form['area_id'] : null;
        $this->form['updated_by'] = User::getCurrentUser()->empleado->id;

        $this->contrato->update($this->form);

        ConvergenciaContratos::updateOrCreate(
            ['contrato_id' => $this->contrato->id],
            ['timesheet_proyecto_id' => TimesheetProyecto::where('identificador', $this->form['no_proyecto'])->value('id'),
             'timesheet_cliente_id' => $this->form['proveedor_id']]
        );

        DolaresContrato::updateOrCreate(
            ['contrato_id' => $this->contrato->id],
            ['monto_dolares' => $this->form['monto_dolares'],
             'maximo_dolares' => $this->form['maximo_dolares'],
             'minimo_dolares' => $this->form['minimo_dolares']]
        );

        session()->flash('success', 'Contrato actualizado correctamente.');
    }

    public function render()
    {
            $this->contrato = Contrato::findOrFail($this->contrato_id);

            $areas = Area::getAll();
            // dd($areas->count());
            $formatoFecha = new FormatearFecha;
            if (! $this->contrato) {
                return redirect()->route('contract_manager.contratos-katbol.index')->with('error', 'Ocurrio un error.');
            }
            $proveedor_id = $this->contrato->proveedor_id;
            $contratos = Contrato::with('ampliaciones', 'dolares')->find($this->contrato_id);
            // dd($contratos);
            $proveedores = TimesheetCliente::get();
            if (! is_null($this->contrato->fecha_inicio)) {
                $this->contrato->fecha_inicio = $this->contrato->fecha_inicio;
            }
            if (! is_null($this->contrato->fecha_fin)) {
                $this->contrato->fecha_fin = $this->contrato->fecha_fin;
            }
            if (! is_null($this->contrato->fecha_firma)) {
                $this->contrato->fecha_firma = $this->contrato->fecha_firma;
            } else {
                $fecha_firma = null;
            }

            $descargar_archivo = '/public/storage/contratos/' . $this->contrato_id . '_contrato_' . $this->contrato->no_contrato . '/' . $this->contrato->file_contrato;

            $this->convenios = ConveniosModificatorios::where('contrato_id', '=', $contratos->id)->get();
            // dd($convenios);
            $dolares = DolaresContrato::where('contrato_id', $this->contrato_id)->first();

            $organizacion = Organizacion::getFirst();

            $proyectos = TimesheetProyecto::getAll()->where('estatus', 'proceso');

            $this->razones_sociales = Sucursal::getArchivoFalse();

            // firmas aprobadores
            $this->firma = FirmaModule::where('modulo_id', '2')->where('submodulo_id', '7')->first();
            // dd($firma->aprobadores);
            // $exampleVar = $firma->aprobadores[0];
            $aprobacionFirmaContrato = AprobadorFirmaContrato::where('contrato_id', $this->contrato_id)->get();

            foreach ($aprobacionFirmaContrato as $firma_item) {
                if ($firma_item->aprobador_id == User::getCurrentUser()->empleado->id) {
                    if (! isset($firma_item->firma)) {
                        $firmar = true;
                    }
                }
                if ($firma_item->firma) {
                    $this->firmado = true;
                }
            }
            $aprobacionFirmaContratoHisotricoLast = AprobadorFirmaContratoHistorico::where('contrato_id', $this->contrato_id)->orderBy('id', 'DESC')->first();

        return view('livewire.contract-manager.update-contrato');
    }
}
