<?php

namespace App\Http\Controllers\ContractManager;

use App\Models\CentroCosto;
use Illuminate\Http\Request;
use App\Models\Organizacion;
use App\Models\ContractManager\Proveedores;
use App\Models\ContractManager\Producto;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequisicionesEmail;
use App\Models\EmpleadoT;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use NumberFormatter;
use PDF;
use App\Http\Controllers\Controller;
use App\Models\ContractManager\CentroCosto as KatbolCentroCosto;
use App\Models\ContractManager\Comprador as KatbolComprador;
use App\Models\ContractManager\Contrato as KatbolContrato;
use App\Models\ContractManager\Moneda as KatbolMoneda;
use App\Models\ContractManager\ProductoRequisicion as KatbolProductoRequisicion;
use App\Models\ContractManager\ProveedorIndistinto as KatbolProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC as KatbolProveedorOC;
use App\Models\ContractManager\Requsicion as KatbolRequsicion;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class OrdenCompraController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            abort_if(Gate::denies('katbol_ordenes_compra_acceso'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $requisiciones =  KatbolRequsicion::with('productos_requisiciones.producto', 'contrato')->where('estado', 'firmada')->Orwhere('estado_orden', 'rechazado_oc')->Orwhere('estado_orden', 'curso')->Orwhere('estado_orden', 'fin')->orderByDesc('id')->get();
            $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
            if (is_null($organizacion_actual)) {
                $organizacion_actual = new Organizacion();
                $organizacion_actual->logotipo = asset('img/logo_katbol.png');
                $organizacion_actual->empresa = 'Silent4Business';
            }
            $logo_actual = $organizacion_actual->logotipo;
            $empresa_actual = $organizacion_actual->empresa;

            $proveedor_indistinto = KatbolProveedorIndistinto::pluck('requisicion_id')->first();

            $requisiciones_id = KatbolRequsicion::get()->pluck('id');
            $ids = [];

            foreach ($requisiciones_id as $id) {
                $ids =  $id;
            }

            return view('contract_manager.ordenes-compra.index', compact('ids', 'requisiciones', 'empresa_actual', 'logo_actual', 'proveedor_indistinto'));

    }

    public function getRequisicionIndex(Request $request)
    {
        $requisiciones =  KatbolRequsicion::with('productos_requisiciones.producto', 'contrato')->where('estado', 'firmada')->Orwhere('estado_orden', 'rechazado_oc')->Orwhere('estado_orden', 'curso')->Orwhere('estado_orden', 'fin')->orderByDesc('id')->get();

        return datatables()->of($requisiciones)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requisicion = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal','productos_requisiciones.producto')->where('archivo', false)->find($id);
        $organizacion = Organizacion::select('empresa', 'logotipo')->first();

        return view('contract_manager.ordenes-compra.show', compact('requisicion','organizacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('katbol_ordenes_compra_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $requisicion = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal','productos_requisiciones.producto')->where('archivo', false)->find($id);
        $proveedores = KatbolProveedorOC::get();
        $proveedor = KatbolProveedorOC::where('id', $requisicion->proveedor_id)->first();
        $contratos = KatbolContrato::get();
        $centro_costos = KatbolCentroCosto::get();
        $monedas = KatbolMoneda::get();
        return view('contract_manager.ordenes-compra.edit', compact('requisicion', 'proveedores', 'contratos', 'centro_costos', 'monedas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requisicion = KatbolRequsicion::find($id);
        $requisicion->update([
            'fecha_entrega' => $request->fecha_entrega,
            'pago' => $request->pago,
            'dias_credito' => $request->dias_credito,
            'moneda' => $request->moneda,
            'cambio' => $request->cambio,

            'proveedor_id' => $request->proveedor_id,
            'direccion_envio_proveedor' => $request->direccion_envio,
            'credito_proveedor' => $request->credito_proveedor,

            'sub_total' => $request->sub_total,
            'iva' => $request->iva ,
            'iva_retenido' => $request->iva_retenido,
            'isr_retenido' => $request->isr_retenido,
            'total' => $request->total,
        ]);

        $productos = KatbolProductoRequisicion::where('requisiciones_id', $requisicion->id)->get();
        foreach ($productos as $producto) {
            $producto->delete();
        }

        $data = $request->all();
        for ($i=1; $i <= $request->count_productos; $i++) {
            $producto_nuevo = KatbolProductoRequisicion::create([
                'cantidad' => $data['cantidad' . $i],
                'producto_id' => $data['producto' . $i],
                'centro_costo_id' => $data['centro_costo' . $i],
                'espesificaciones' => $data['especificaciones' . $i],
                'contrato_id' => $data['contrato' . $i],
                'requisiciones_id' => $requisicion->id,
                'no_personas' => $data['no_personas' . $i],
                'porcentaje_involucramiento' => $data['porcentaje_involucramiento' . $i],
                'sub_total' => $data['sub_total' . $i],
                'iva' => $data['iva' . $i],
                'iva_retenido' => $data['iva_retenido' . $i],
                'descuento' => $data['descuento' . $i],
                'otro_impuesto' => $data['otro_impuesto' . $i],
                'isr_retenido' => $data['isr_retenido' . $i],
                'total' => $data['total' . $i],
            ]);
        }

        $proveedor = KatbolProveedorOC::find($request->proveedor_id);

        $proveedor->update([
            'direccion' => $request->direccion,
            'facturacion' => $request->facturacion,
            'envio' => $request->direccion_envio,
            'credito' => $request->credito_proveedor
        ]);

        return redirect(route('contract_manager.orden-compra.firmar', ['tipo_firma' => 'firma_comprador_orden', 'id' => $requisicion->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function firmar($tipo_firma, $id)
    {
            $requisicion = KatbolRequsicion::find($id);
            $organizacion = Organizacion::first();
            $contrato = KatbolContrato::where('id',$requisicion->contrato_id)->first();
            $proveedores = KatbolProveedorOC::where('id', $requisicion->proveedor_id)->get();
            $comprador = KatbolComprador::with('user')->where('id',$requisicion->comprador_id)->first();
            $proveedores_catalogo = KatbolProveedorOC::where('id', $requisicion->proveedor_catalogo_id)->first();
            return view('contract_manager.ordenes-compra.firmar', compact('requisicion', 'proveedores', 'organizacion', 'contrato', 'comprador', 'tipo_firma', 'proveedores_catalogo'));
    }

    public function FirmarUpdate(Request $request, $tipo_firma, $id)
    {

        $request->validate([
            'firma' => 'required',
        ]);

        $requisicion = KatbolRequsicion::find($id);

        $requisicion->update([
            $tipo_firma => $request->firma,
            'estado_orden' => 'curso',
        ]);

        if($tipo_firma == 'firma_solicitante_orden'){

            $fecha =  date('d-m-Y');
            $requisicion->fecha_firma_solicitante_orden =  $fecha;
            $requisicion->save();

            $user =  'lourdes.abadia@silent4business.com';
            $userEmail = $user;
        }
        if($tipo_firma == 'firma_comprador_orden'){
            $fecha =  date('d-m-Y');
            $requisicion->fecha_firma_comprador_orden =  $fecha;
            $requisicion->save();

            // correo de compras orden
            $comprador = KatbolComprador::where('id', $requisicion->comprador_id)->first();
            // correo de finanzas
            $userEmail = $comprador->user->email;
        }
        if($tipo_firma == 'firma_finanzas_orden'){
            $fecha =  date('d-m-Y');
            $requisicion->fecha_firma_finanzas_orden =  $fecha;
            $requisicion->save();

            $requisicion->update([
                'estado' => 'firmada_final',
                'estado_orden' => 'fin',
            ]);
            // correo de finanzas
            $userEmail = $requisicion->email;
        }
        $organizacion = Organizacion::first();
        Mail::to('saul.ramirez@silent4business.com')->send(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));

        return redirect('contract_manager/orden-compra');


    }

      /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function rechazada($id)
    {
        $requisicion= KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal','productos_requisiciones.producto')->where('id', $id)->first();

        $requisicion->update([
            'estado' => 'firma_requisicion',
            'firma_solicitante_orden' => null,
            'firma_finanzas_orden' => null,
            'firma_comprador_orden' => null,
            'estado_orden' => 'rechazado_oc',
        ]);

        $userEmail = Auth::user()->email;
        $organizacion = Organizacion::first();
        $tipo_firma = 'rechazado';
        Mail::to($requisicion->email)->send(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
        return redirect('contract_manager/orden-compra');

    }

    public function pdf($id)
    {

        $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal','productos_requisiciones.producto')->where('archivo', false)->find($id);
        $organizacion = Organizacion::select('empresa', 'logotipo')->first();

        $f = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $numero= $requisiciones->total;
        $letras = $f->format($numero);

        $proveedores = KatbolProveedorOC::where('id', $requisiciones->proveedor_id)->first();
        $pdf = PDF::loadView('orden_compra_pdf', compact('requisiciones', 'organizacion', 'proveedores', 'letras'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf-> download('orden_compra.pdf');
    }
}
