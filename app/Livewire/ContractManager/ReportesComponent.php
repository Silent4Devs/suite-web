<?php

namespace App\Livewire\ContractManager;

use App\Models\ContractManager\AmpliacionContrato as KatbolAmpliacionContrato;
use App\Models\ContractManager\CedulaCumplimiento as KatbolCedulaCumplimiento;
use App\Models\ContractManager\CierreContrato as KatbolCierreContrato;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\EntregaMensual as KatbolEntregaMensual;
use App\Models\ContractManager\Factura as KatbolFactura;
use App\Models\ContractManager\NivelesServicio as KatbolNivelesServicio;
use App\Models\ContractManager\Proveedores as KatbolProveedores;
use App\Models\Organizacion;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReportesComponent extends Component
{
    public $proveedores;

    public $contratos;

    public $organizacion;

    public $count;

    public $logotipo;

    public $proveedor_id = '';

    public $contrato_id = '';

    public $reporte;

    public $reporte_contrato_generado = '';

    public $reporte_proveedor_generado = '';

    public $proveedor_seleccionado;

    public $contratos_de_proveedor;

    public function render()
    {
        $this->proveedores = KatbolProveedores::get();
        $this->contratos = Contrato::getAll();
        $this->organizacion = Organizacion::getFirst();
        $this->count = Organizacion::getAll()->count();
        $this->logotipo = DB::table('organizacions')->get('logotipo');

        if (empty($this->organizacion)) {

            $empty = false;

            return view('livewire.contract-manager.reportes-component')->with('organizacion', $this->organizacion)->with('count', $this->count)->with('empty', $empty);
        } else {
            $empty = true;

            return view('livewire.contract-manager.reportes-component')->with('organizacion', $this->organizacion)->with('count', $this->count)->with('empty', $empty)->with('logotipo', $this->logotipo[0]);
        }
    }

    public function getProveedorID()
    {
        $this->proveedor_seleccionado = KatbolProveedores::where('id', '=', $this->proveedor_id)->get();
        $this->contratos_de_proveedor = Contrato::where('proveedor_id', '=', $this->proveedor_id)->get();

        $this->reporte_proveedor_generado = view(
            'contract_manager.reportes.proveedor_template',
            compact(
                'proveedor_seleccionado',
                'contratos_de_proveedor',
            )
        )->render();

    }

    public function getContratoID()
    {

        $contrato_seleccionado = Contrato::where('id', $this->contrato_id)->get();
        $cedula_cumplimiento = KatbolCedulaCumplimiento::where('contrato_id', $this->contrato_id)->get();
        $facturas_de_contrato = KatbolFactura::where('contrato_id', $this->contrato_id)->get();
        $niveles_de_contrato = KatbolNivelesServicio::where('contrato_id', $this->contrato_id)->get();
        $entregables_de_contrato = KatbolEntregaMensual::where('contrato_id', $this->contrato_id)->get();
        $cierre_de_contrato = KatbolCierreContrato::where('contrato_id', $this->contrato_id)->get();
        $ampliacion_de_contrato = KatbolAmpliacionContrato::where('contrato_id', $this->contrato_id)->get();

        $hoy = date('d/m/y');
        $this->reporte_contrato_generado = view(
            'contract_manager.reportes.contrato_template',
            compact(
                'contrato_seleccionado',
                'cedula_cumplimiento',
                'facturas_de_contrato',
                'niveles_de_contrato',
                'entregables_de_contrato',
                'cierre_de_contrato',
                'ampliacion_de_contrato',
                'hoy'
            )
        )->render();
    }
}
