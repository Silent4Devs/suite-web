<?php

namespace App\Livewire;

use App\Functions\FormatearFecha;
use App\Models\AprobadorFirmaContrato;
use App\Models\AprobadorFirmaContratoHistorico;
use App\Models\Area;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\ConveniosModificatorios;
use App\Models\ContractManager\DolaresContrato;
use App\Models\ContractManager\Sucursal;
use App\Models\FirmaModule;
use App\Models\Organizacion;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use App\Models\User;
use App\Rules\NumeroContrato;
use Livewire\Component;

class FormularioEditarContratosLivewire extends Component
{

    //Constantes de formulario
    public $show_contrato;

    public $razones_sociales = null;

    public $proyectos = null;

    public $prov_id = null;

    public $dolares = null;

    public $organizacion = null;

    public $areas = null;

    public $firma = null;

    public $firmar = null;

    public $firmado = null;

    public $aprobacionFirmaContrato = null;

    public $aprobacionFirmaContratoHisotricoLast = null;

    public $contrato = null;

    public $proveedores = null;

    public $contratos = null;

    public $ids = null;

    public $descargar_archivo = null;

    public $convenios = null;

    //Inputs de formulario

    #[Validate('required')]
    //, new NumeroContrato($this->id)
    public $no_contrato = null;

    #[Validate('required')]
    public $no_proyecto = null;

    #[Validate('required|max:500')]
    public $nombre_servicio = null;

    #[Validate('required')]
    public $tipo_contrato = null;

    #[Validate('required')]
    public $proveedor_id = null;

    #[Validate('required|max:500')]
    public $objetivo = null;

    #[Validate('required|max:255')]
    public $estatus = null;

    #[Validate('required')]
    public $file_contrato = null;

    #[Validate('nullable|max:250')]
    public $cargo_administrador = null;

    #[Validate('nullable|max:250')]
    public $area_administrador = null;

    #[Validate('nullable|max:250')]
    public $puesto = null;

    #[Validate('nullable|max:250')]
    public $area = null;

    #[Validate('required')]
    public $fase = null;

    #[Validate('required|max:255')]
    public $vigencia_contrato = null;

    #[Validate('required|date')]
    public $fecha_inicio = null;

    #[Validate('required|date|after:fecha_inicio')]
    public $fecha_fin = null;

    #[Validate('required')]
    public $area_id = null;

    #[Validate('required|date|before_or_equal:fecha_fin|after:fecha_inicio')]
    public $fecha_firma = null;

    #[Validate('required|numeric|lte:500000')]
    public $no_pagos = null;

    #[Validate('required')]
    public $tipo_cambio = null;

    #[Validate('required|numeric|min:0|max:99999999999.99')]
    public $monto_pago = null;

    #[Validate('nullable|numeric|max:99999999999.99')]
    public $minimo = null;

    #[Validate('nullable|numeric|max:99999999999.99')]
    public $maximo = null;

    #[Validate('nullable|numeric|max:99999999999.99')]
    public $monto_dolares = null;

    #[Validate('nullable|numeric|max:99999999999.99')]
    public $maximo_dolares = null;

    #[Validate('nullable|numeric|max:99999999999.99')]
    public $minimo_dolares = null;

    #[Validate('nullable|numeric|max:99999999999.99')]
    public $valor_dolar = null;

    #[Validate('required|integer')]
    public $razon_soc_id = null;


    public function mount($IDContrato, $showC = null){

        $this->contrato = Contrato::with('ampliaciones', 'dolares')->find($IDContrato);

        if (!$this->contrato) {
            return redirect()->route('contract_manager.contratos-katbol.index')->with('error', 'Ocurrio un error.');
        }

        $this->show_contrato = $showC;
        $this->areas = Area::all();
        $this->prov_id = $this->contrato->proveedor_id;
        $this->proveedores = TimesheetCliente::all();
        $this->convenios = ConveniosModificatorios::where('contrato_id', $this->contrato->id)->get();
        $this->dolares = DolaresContrato::where('contrato_id', $IDContrato)->first();
        $this->organizacion = Organizacion::first();
        $this->proyectos = TimesheetProyecto::where('estatus', 'proceso')->get();
        $this->razones_sociales = Sucursal::where('archivo', false)->get();
        $this->descargar_archivo = storage_path('app/public/contratos/' . "{$this->contrato->id}_contrato_{$this->contrato->no_contrato}/{$this->contrato->file_contrato}");

        $this->firma = FirmaModule::where([
            ['modulo_id', 2],
            ['submodulo_id', 7]
        ])->first();

        $aprobacionFirmaContrato = AprobadorFirmaContrato::where('contrato_id', $this->contrato->id)->get();
        $this->firmar = $aprobacionFirmaContrato->contains(function ($firma_item) {
            return $firma_item->aprobador_id == User::getCurrentUser()->empleado->id && is_null($firma_item->firma);
        });
        $this->firmado = $aprobacionFirmaContrato->contains('firma', '!=', null);

        $this->aprobacionFirmaContratoHisotricoLast = AprobadorFirmaContratoHistorico::where('contrato_id', $this->contrato->id)->latest()->first();

        $this->tipo_contrato = $this->contrato->tipo_contrato;
        $this->identificador_privado = $this->contrato->identificador_privado;
        $this->no_contrato = $this->contrato->num_contrato;
        $this->nombre_servicio = $this->contrato->nombre_servicio;
        $this->proveedor_id = $this->contrato->proveedor_id;
        $this->objetivo = $this->contrato->objetivo;
        $this->vigencia_contrato = $this->contrato->vigencia_contrato;
        $this->estatus = $this->contrato->estatus;
        $this->fecha_inicio = $this->contrato->fecha_inicio;
        $this->fecha_fin = $this->contrato->fecha_fin;
        $this->administrador_contrato = $this->contrato->administrador_contrato;
        $this->file_contrato = $this->contrato->file_contrato;
        $this->cargo_administrador = $this->contrato->cargo_administrador;
        $this->fecha_firma = $this->contrato->fecha_firma;
        $this->no_pagos = $this->contrato->no_pagos;
        $this->monto_pago = $this->contrato->monto_pago;
        $this->minimo = $this->contrato->minimo;
        $this->maximo = $this->contrato->maximo;
        $this->fase = $this->contrato->fase;
        $this->pmp_asignado = $this->contrato->pmp_asignado;
        $this->puesto = $this->contrato->puesto;
        $this->area = $this->contrato->area;
        $this->folio = $this->contrato->folio;
        $this->tipo_cambio = $this->contrato->tipo_cambio;
        $this->area_administrador = $this->contrato->area_administrador;
        $this->no_proyecto = $this->contrato->no_proyecto;
        $this->area_id = $this->contrato->area_id;
        $this->razon_soc_id = $this->contrato->razon_soc_id;
    }

    public function render()
    {
        return view('livewire.formulario-editar-contratos-livewire');
    }
}
