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
use Livewire\Component;

class FormularioEditarContratosLivewire extends Component
{

    public $show_contrato;

    public $razones_sociales = null;

    public $proyectos = null;

    public $proveedor_id = null;

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

    public function mount($IDContrato, $showC = null){

        $this->contrato = Contrato::with('ampliaciones', 'dolares')->find($IDContrato);

        if (!$this->contrato) {
            return redirect()->route('contract_manager.contratos-katbol.index')->with('error', 'Ocurrio un error.');
        }

        $this->show_contrato = $showC;
        $this->areas = Area::all();
        $this->proveedor_id = $this->contrato->proveedor_id;
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

    }

    public function render()
    {
        return view('livewire.formulario-editar-contratos-livewire');
    }
}
