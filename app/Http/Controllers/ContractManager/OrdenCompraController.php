<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Mail\RequisicionesEmail;
use App\Models\ContractManager\CentroCosto as KatbolCentroCosto;
use App\Models\ContractManager\Comprador as KatbolComprador;
use App\Models\ContractManager\Contrato as KatbolContrato;
use App\Models\ContractManager\Moneda as KatbolMoneda;
use App\Models\ContractManager\ProductoRequisicion as KatbolProductoRequisicion;
use App\Models\ContractManager\ProveedorIndistinto as KatbolProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC as KatbolProveedorOC;
use App\Models\ContractManager\Requsicion as KatbolRequsicion;
use App\Models\Organizacion;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use NumberFormatter;
use PDF;
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
        $user = Auth::user();

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo_katbol.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;
        $proveedor_indistinto = KatbolProveedorIndistinto::pluck('requisicion_id')->first();

        $id = Auth::user()->id;
        $roles = User::find($id)->roles()->get();
        foreach ($roles as $rol) {
            if ($rol->title === 'Admin') {
                $requisiciones = KatbolRequsicion::where([
                    ['firma_solicitante', '!=', null],
                    ['firma_jefe', '!=', null],
                    ['firma_finanzas', '!=', null],
                    ['firma_compras', '!=', null],
                ])->where('archivo', false)->orderByDesc('id')
                    ->get();

                return view('contract_manager.ordenes-compra.index', compact('requisiciones', 'empresa_actual', 'logo_actual', 'proveedor_indistinto'));
            } elseif ($rol->title === 'Compras') {
                //compras
                $comprador = KatbolComprador::where('id_user', $user->empleado_id)->first();
                $id = 0;
                if ($comprador) {
                    $id = $comprador->id;
                }
                $requisiciones = KatbolRequsicion::where([
                    ['firma_solicitante', '!=', null],
                    ['firma_jefe', '!=', null],
                    ['firma_finanzas', '!=', null],
                    ['firma_compras', '!=', null],
                ])->where('archivo', false)
                    ->where('comprador_id', $id)
                    ->orderByDesc('id')
                    ->get();

                return view('contract_manager.ordenes-compra.index', compact('requisiciones', 'empresa_actual', 'logo_actual', 'proveedor_indistinto'));
            } else {
                $requisiciones = KatbolRequsicion::where([
                    ['firma_solicitante', '!=', null],
                    ['firma_jefe', '!=', null],
                    ['firma_finanzas', '!=', null],
                    ['firma_compras', '!=', null],
                ])->where('archivo', false)
                    ->where('id_user', $user->id)
                    ->orderByDesc('id')
                    ->get();

                return view('contract_manager.ordenes-compra.index', compact('requisiciones', 'empresa_actual', 'logo_actual', 'proveedor_indistinto'));
            }
        }
    }

    public function getRequisicionIndex(Request $request)
    {
        $id = Auth::user()->id;
        $roles = User::find($id)->roles()->get();
        foreach ($roles as $rol) {
            if ($rol->title === 'Admin') {
                $requisiciones = KatbolRequsicion::with('contrato')->where([
                    ['firma_solicitante', '!=', null],
                    ['firma_jefe', '!=', null],
                    ['firma_finanzas', '!=', null],
                    ['firma_compras', '!=', null],
                ])->where('archivo', false)->orderByDesc('id')
                    ->get();

                return datatables()->of($requisiciones)->toJson();
            } elseif ($rol->title === 'Compras') {
                $user = Auth::user();
                $comprador = KatbolComprador::where('id_user', $user->empleado_id)->first();
                $id = 0;
                if ($comprador) {
                    $id = $comprador->id;
                }
                $requisiciones = KatbolRequsicion::with('contrato')->where([
                    ['firma_solicitante', '!=', null],
                    ['firma_jefe', '!=', null],
                    ['firma_finanzas', '!=', null],
                    ['firma_compras', '!=', null],
                ])->where('archivo', false)
                    ->where('comprador_id', $id)
                    ->orderByDesc('id')
                    ->get();

                return datatables()->of($requisiciones)->toJson();
            } else {
                $user = Auth::user();
                $requisiciones = KatbolRequsicion::with('contrato')->where([
                    ['firma_solicitante', '!=', null],
                    ['firma_jefe', '!=', null],
                    ['firma_finanzas', '!=', null],
                    ['firma_compras', '!=', null],
                ])->where('archivo', false)
                    ->where('id_user', $user->id)
                    ->orderByDesc('id')
                    ->get();

                return datatables()->of($requisiciones)->toJson();
            }
        }
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
        try {
            $requisicion = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', false)->find($id);
            $organizacion = Organizacion::select('empresa', 'logotipo')->first();

            return view('contract_manager.ordenes-compra.show', compact('requisicion', 'organizacion'));
        } catch (\Exception $e) {
            return view('contract_manager.ordenes-compra.error');
        }
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
        $requisicion = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', false)->find($id);
        $proveedores = KatbolProveedorOC::get();
        $proveedor = KatbolProveedorOC::where('id', $requisicion->proveedor_id)->first();
        $contratos = KatbolContrato::get();
        $centro_costos = KatbolCentroCosto::get();
        $monedas = KatbolMoneda::get();
        $contrato = KatbolContrato::where('id', $requisicion->contrato_id)->first();

        return view('contract_manager.ordenes-compra.edit', compact('requisicion', 'proveedores', 'contratos', 'centro_costos', 'monedas', 'contrato'));
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
            // 'proveedor_id' => $request->proveedor_id,
            'direccion_envio_proveedor' => $request->direccion_envio,
            'credito_proveedor' => $request->credito_proveedor,

            'sub_total' => $request->sub_total,
            'iva' => $request->iva,
            'iva_retenido' => $request->iva_retenido,
            'isr_retenido' => $request->isr_retenido,
            'total' => $request->total,
        ]);

        $productos = KatbolProductoRequisicion::where('requisiciones_id', $requisicion->id)->get();
        foreach ($productos as $producto) {
            $producto->delete();
        }

        $data = $request->all();
        for ($i = 1; $i <= $request->count_productos; $i++) {
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
            'credito' => $request->credito_proveedor,
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
        KatbolRequsicion::destroy($id);

        notify()->success('¡El registro fue eliminado exitosamente!');

        return redirect(route('contract_manager.orden-compra'));
    }

    public function firmar($tipo_firma, $id)
    {
        try {
            $requisicion = KatbolRequsicion::find($id);
            $organizacion = Organizacion::first();
            $contrato = KatbolContrato::where('id', $requisicion->contrato_id)->first();
            $proveedores = KatbolProveedorOC::where('id', $requisicion->proveedor_id)->get();
            $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();
            $proveedores_catalogo = KatbolProveedorOC::where('id', $requisicion->proveedor_catalogo_id)->first();

            return view('contract_manager.ordenes-compra.firmar', compact('requisicion', 'proveedores', 'organizacion', 'contrato', 'comprador', 'tipo_firma', 'proveedores_catalogo'));
        } catch (\Exception $e) {
            return view('contract_manager.ordenes-compra.error');
        }
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

        if ($tipo_firma == 'firma_solicitante_orden') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_solicitante_orden = $fecha;
            $requisicion->save();
            $user = 'lourdes.abadia@silent4business.com';
            $userEmail = $user;
        }
        if ($tipo_firma == 'firma_comprador_orden') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_comprador_orden = $fecha;
            $requisicion->save();

            // correo de finanzas
            $userEmail = $requisicion->email;
        }
        if ($tipo_firma == 'firma_finanzas_orden') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_finanzas_orden = $fecha;
            $requisicion->save();

            $requisicion->update([
                'estado' => 'firmada_final',
                'estado_orden' => 'fin',
            ]);

            $userEmail = $requisicion->email;
        }
        $organizacion = Organizacion::first();
        Mail::to($userEmail)->send(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));

        return redirect(route('contract_manager.orden-compra'));
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function rechazada($id)
    {
        $requisicion = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('id', $id)->first();

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
        try {
            $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', false)->find($id);
            $organizacion = Organizacion::select('empresa', 'logotipo')->first();

            $f = new NumberFormatter('es', NumberFormatter::SPELLOUT);
            $numero = $requisiciones->total;
            $letras = $f->format($numero);

            $proveedores = KatbolProveedorOC::where('id', $requisiciones->proveedor_id)->first();
            $pdf = PDF::loadView('orden_compra_pdf', compact('requisiciones', 'organizacion', 'proveedores', 'letras'));
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('orden_compra.pdf');
        } catch (\Exception $e) {
            return view('contract_manager.ordenes-compra.error');
        }
    }
}