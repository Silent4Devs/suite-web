<?php

namespace App\Livewire\ContractManager;

use App\Models\ContractManager\AmpliacionContrato as KatbolAmpliacionContrato;
use App\Models\ContractManager\CedulaCumplimiento as KatbolCedulaCumplimiento;
use App\Models\ContractManager\CierreContrato as KatbolCierreContrato;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\EntregaMensual as KatbolEntregaMensual;
use App\Models\ContractManager\Factura as KatbolFactura;
use App\Models\ContractManager\NivelesServicio as KatbolNivelesServicio;
use App\Models\Organizacion;
use App\Models\TimesheetCliente as KatbolProveedores;
use PDF;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReportesComponent extends Component
{
    public $showMenu;

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
        $proveedor_seleccionado = KatbolProveedores::where('id', '=', $this->proveedor_id)->get();
        $contratos_de_proveedor = Contrato::where('proveedor_id', '=', $this->proveedor_id)->get();
        $organizacion = Organizacion::getFirst();


        $hoy = date('d/m/y');
        $this->reporte_proveedor_generado = view(
            'contract_manager.reportes.proveedor_template',
            compact(
                'proveedor_seleccionado',
                'contratos_de_proveedor',
                'organizacion',
                'hoy'
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

        $organizacion = Organizacion::getFirst();

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
                'organizacion',
                'hoy'
            )
        )->render();
    }
    public function setMenu($menu)
    {

        $this->showMenu = $menu;
    }
    public function imprimirReporteOrganizacion()
    {
        $organizacion = $this->organizacion;
        $pdf = Pdf::loadView('contract_manager/reportes/organizacion-Pdf', compact('organizacion'));
        $pdf->setPaper('A4', 'portrait'); // Ajustar papel y orientación// Retornar el PDF como descarga
        return response()->streamDownload(
            fn() => print($pdf->output()),
            'reportes_organizacion.pdf'
        );
    }
    public function imprimirReporteContrato()
    {
        // Obtén los datos necesarios para la vista del reporte
        $contrato_seleccionado = Contrato::where('id', $this->contrato_id)->get();
        $cedula_cumplimiento = KatbolCedulaCumplimiento::where('contrato_id', $this->contrato_id)->get();
        $facturas_de_contrato = KatbolFactura::where('contrato_id', $this->contrato_id)->get();
        $niveles_de_contrato = KatbolNivelesServicio::where('contrato_id', $this->contrato_id)->get();
        $entregables_de_contrato = KatbolEntregaMensual::where('contrato_id', $this->contrato_id)->get();
        $cierre_de_contrato = KatbolCierreContrato::where('contrato_id', $this->contrato_id)->get();
        $ampliacion_de_contrato = KatbolAmpliacionContrato::where('contrato_id', $this->contrato_id)->get();

        // Incluye la organización
        $organizacion = Organizacion::getFirst();

        // Fecha actual
        $hoy = date('d/m/y');

        // Genera el PDF con la vista y los datos necesarios
        $pdf = Pdf::loadView('contract_manager/reportes/contrato-pdf', compact(
            'contrato_seleccionado',
            'cedula_cumplimiento',
            'facturas_de_contrato',
            'niveles_de_contrato',
            'entregables_de_contrato',
            'cierre_de_contrato',
            'ampliacion_de_contrato',
            'organizacion',
            'hoy'
        ));

        // Configura el tamaño y orientación del PDF
        $pdf->setPaper('A4', 'portrait');

        // Retorna el PDF como descarga
        return response()->streamDownload(
            fn() => print($pdf->output()),
            'contrato-pdf.pdf'
        );
    }
    public function imprimirReporteProveedor()
    {
        $proveedor_seleccionado = KatbolProveedores::where('id', '=', $this->proveedor_id)->get();
        $contratos_de_proveedor = Contrato::where('proveedor_id', '=', $this->proveedor_id)->get();
        $organizacion = Organizacion::getFirst();
        $hoy = date('d/m/y');

        $pdf = Pdf::loadView('contract_manager/reportes/proveedor-pdf', compact(
            'proveedor_seleccionado',
            'contratos_de_proveedor',
            'organizacion',
            'hoy'
        ));

        // Configura el tamaño y orientación del PDF
        $pdf->setPaper('A4', 'portrait');
        // Retorna el PDF como descarga
        return response()->streamDownload(
            fn() => print($pdf->output()),
            'contrato-pdf.pdf'
        );
    }
}
