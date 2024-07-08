<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Mail\RequisicionesEmail;
use App\Models\ContractManager\CentroCosto as KatbolCentroCosto;
use App\Models\ContractManager\Comprador as KatbolComprador;
use App\Models\ContractManager\Contrato as KatbolContrato;
use App\Models\ContractManager\Moneda as KatbolMoneda;
use App\Models\ContractManager\ProductoRequisicion as KatbolProductoRequisicion;
use App\Models\ContractManager\ProvedorRequisicionCatalogo as KatbolProvedorRequisicionCatalogo;
use App\Models\ContractManager\ProveedorIndistinto as KatbolProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC as KatbolProveedorOC;
use App\Models\ContractManager\Requsicion as KatbolRequsicion;
use App\Models\Organizacion;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use NumberFormatter;
use PDF;
use Symfony\Component\HttpFoundation\Response;

class OrdenCompraController extends Controller
{
    use ObtenerOrganizacion;

    public $bandera = true;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::getCurrentUser();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;
        $buttonSolicitante = false;
        $buttonFinanzas = false;
        $buttonCompras = false;

        $proveedor_indistinto = KatbolProveedorIndistinto::getFirst()->pluck('requisicion_id');

        $requisiciones = KatbolRequsicion::where([
            ['firma_solicitante', '!=', null],
            ['firma_jefe', '!=', null],
            ['firma_finanzas', '!=', null],
            ['firma_compras', '!=', null],
        ])->where('archivo', false)->orderByDesc('id')
            ->get();

        return view('contract_manager.ordenes-compra.index', compact('buttonSolicitante', 'buttonFinanzas', 'buttonCompras', 'requisiciones', 'empresa_actual', 'logo_actual', 'proveedor_indistinto'));
    }

    public function getRequisicionIndex(Request $request)
    {
        $id = User::getCurrentUser()->id;

        $requisiciones = KatbolRequsicion::with('contrato')->where([
            ['firma_solicitante', '!=', null],
            ['firma_jefe', '!=', null],
            ['firma_finanzas', '!=', null],
            ['firma_compras', '!=', null],
        ])->where('archivo', false)->orderByDesc('id')
            ->get();

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
            $user = User::find($requisicion->id_finanzas_oc);
            $proveedores = KatbolProveedorOC::where('id', $requisicion->proveedor_id)->first();

            if ($user) {
                $firma_finanzas_name = $user->name;
            } else {
                $firma_finanzas_name = null;
            }

            $organizacion = Organizacion::getLogo();

            if (! $requisicion) {
                abort(404);
            }

            return view('contract_manager.ordenes-compra.show', compact('firma_finanzas_name', 'requisicion', 'organizacion', 'proveedores'));
        } catch (\Throwable $th) {
            abort(404);
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

        try {

            abort_if(Gate::denies('katbol_ordenes_compra_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $requisicion = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', false)->find($id);
            if (! $requisicion) {
                abort(404);
            }
            $proveedores = KatbolProveedorOC::get();
            $proveedor = $proveedores->where('id', $requisicion->proveedor_id)->first();
            $contratos = KatbolContrato::getAll();
            $centro_costos = KatbolCentroCosto::get();
            $monedas = KatbolMoneda::get();
            $contrato = $contratos->where('id', $requisicion->contrato_id)->first();

            return view('contract_manager.ordenes-compra.edit', compact('requisicion', 'proveedores', 'contratos', 'centro_costos', 'monedas', 'contrato'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
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
                'cantidad' => $data['cantidad'.$i],
                'producto_id' => $data['producto'.$i],
                'centro_costo_id' => $data['centro_costo'.$i],
                'espesificaciones' => $data['especificaciones'.$i],
                'contrato_id' => $data['contrato'.$i],
                'requisiciones_id' => $requisicion->id,
                'no_personas' => $data['no_personas'.$i],
                'porcentaje_involucramiento' => $data['porcentaje_involucramiento'.$i],
                'sub_total' => $data['sub_total'.$i],
                'iva' => $data['iva'.$i],
                'iva_retenido' => $data['iva_retenido'.$i],
                'descuento' => $data['descuento'.$i],
                'otro_impuesto' => $data['otro_impuesto'.$i],
                'isr_retenido' => $data['isr_retenido'.$i],
                'total' => $data['total'.$i],
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
            $organizacion = Organizacion::getFirst();
            $contrato = KatbolContrato::where('id', $requisicion->contrato_id)->first();
            $proveedores = KatbolProveedorOC::where('id', $requisicion->proveedor_id)->get();
            $user = User::find($requisicion->id_finanzas_oc);

            if ($user) {
                $firma_finanzas_name = $user->name;
            } else {
                $firma_finanzas_name = null;
            }
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

            $organizacion = Organizacion::getFirst();

            Mail::to('ldelgadillo@silent4business.com')->cc('aurora.soriano@silent4business.com')->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
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
            $user = User::getCurrentUser();
            $requisicion->id_finanzas_oc = $user->id;
            $requisicion->save();

            $requisicion->update([
                'estado' => 'firmada_final',
                'estado_orden' => 'fin',
            ]);

            $userEmail = $requisicion->email;
        }

        $organizacion = Organizacion::getFirst();
        Mail::to($userEmail)->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));

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

        $userEmail = User::getCurrentUser()->email;
        $organizacion = Organizacion::getFirst();
        $tipo_firma = 'rechazado';
        Mail::to($requisicion->email)->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));

        return redirect('contract_manager/orden-compra');
    }

    public function pdf($id)
    {

        $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', false)->find($id);
        $user = User::find($requisiciones->id_finanzas_oc);

        if ($user) {
            $firma_finanzas_name = $user->name;
        } else {
            $firma_finanzas_name = null;
        }

        $organizacion = Organizacion::getLogo();

        $f = new NumberFormatter('es', NumberFormatter::SPELLOUT);
        $numero = $requisiciones->total;
        $letras = $f->format($numero);

        $proveedores = KatbolProveedorOC::where('id', $requisiciones->proveedor_id)->first();
        $pdf = PDF::loadView('orden_compra_pdf', compact('firma_finanzas_name', 'requisiciones', 'organizacion', 'proveedores', 'letras'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('orden_compra.pdf');
    }

    public function filtrarPorEstado3()
    {
        $requisiciones = KatbolRequsicion::where([
            ['firma_solicitante', '!=', null],
            ['firma_jefe', '!=', null],
            ['firma_finanzas', '!=', null],
            ['firma_compras', '!=', null],
        ])->where('firma_comprador_orden', null)->get();

        $buttonSolicitante = false;
        $buttonFinanzas = false;
        $buttonCompras = true;
        toast('Filtro compradores aplicado!', 'success');

        return view('contract_manager.ordenes-compra.aprobadores', compact('requisiciones', 'buttonSolicitante', 'buttonFinanzas', 'buttonCompras'));
    }

    public function filtrarPorEstado2()
    {
        $requisiciones = KatbolRequsicion::where([
            ['firma_solicitante', '!=', null],
            ['firma_jefe', '!=', null],
            ['firma_finanzas', '!=', null],
            ['firma_compras', '!=', null],
        ])->whereNotNull('firma_comprador_orden')->where('firma_solicitante_orden', null)->get();
        $buttonSolicitante = true;
        $buttonFinanzas = false;
        $buttonCompras = false;
        toast('Filtro solicitante aplicado!', 'success');

        return view('contract_manager.ordenes-compra.aprobadores', compact('requisiciones', 'buttonSolicitante', 'buttonFinanzas', 'buttonCompras'));
    }

    public function filtrarPorEstado()
    {
        $requisiciones = KatbolRequsicion::where([
            ['firma_solicitante', '!=', null],
            ['firma_jefe', '!=', null],
            ['firma_finanzas', '!=', null],
            ['firma_compras', '!=', null],
        ])->whereNotNull('firma_solicitante_orden')->whereNotNull('firma_comprador_orden')->where('firma_finanzas_orden', null)->get();
        $buttonSolicitante = false;
        $buttonFinanzas = true;
        $buttonCompras = false;
        toast('Filtro finanzas aplicado!', 'success');

        return view('contract_manager.ordenes-compra.aprobadores', compact('requisiciones', 'buttonSolicitante', 'buttonFinanzas', 'buttonCompras'));
    }

    public function indexAprobadores()
    {
        $requisiciones = KatbolRequsicion::where([
            ['firma_solicitante', '!=', null],
            ['firma_jefe', '!=', null],
            ['firma_finanzas', '!=', null],
            ['firma_compras', '!=', null],
        ])->with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', false)->orderByDesc('id')->get();
        $proveedor_indistinto = KatbolProveedorIndistinto::pluck('requisicion_id')->first();
        $buttonSolicitante = false;
        $buttonFinanzas = false;
        $buttonCompras = false;

        return view('contract_manager.ordenes-compra.aprobadores', compact('requisiciones', 'proveedor_indistinto', 'buttonSolicitante', 'buttonFinanzas', 'buttonCompras'));
    }

    public function firmarAprobadores($id)
    {
        $bandera = true;
        $requisicion = KatbolRequsicion::where([
            ['firma_solicitante', '!=', null],
            ['firma_jefe', '!=', null],
            ['firma_finanzas', '!=', null],
            ['firma_compras', '!=', null],
        ])->where('id', $id)->first();

        $user = User::getCurrentUser();
        $supervisor = User::find($requisicion->id_user)->empleado->supervisor->name;
        $supervisor_email = User::find($requisicion->id_user)->empleado->supervisor->email;
        $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();
        $solicitante = User::find($requisicion->id_user);

        if ($requisicion->firma_comprador_orden === null) {
            if (removeUnicodeCharacters($comprador->user->email) === removeUnicodeCharacters($user->email)) {
                $tipo_firma = 'firma_comprador_orden';
            } else {
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del comprador directo: <br> <strong>'.$comprador->user->name.'</strong>');
            }
        } elseif ($requisicion->firma_solicitante_orden === null) {
            if (removeUnicodeCharacters($user->email) === removeUnicodeCharacters($solicitante->email)) {
                $tipo_firma = 'firma_solicitante_orden';
            } else {
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del solicitante directo: <br> <strong>'.$solicitante->name.'</strong>');
            }
        } elseif ($requisicion->firma_finanzas_orden === null) {
            if (removeUnicodeCharacters($user->email) === 'lourdes.abadia@silent4business.com' || removeUnicodeCharacters($user->email) === 'ldelgadillo@silent4business.com' || removeUnicodeCharacters($user->email) === 'aurora.soriano@silent4business.com') {
                $tipo_firma = 'firma_finanzas_orden';
            } else {
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del finanzas');
            }
        } elseif ($requisicion->firma_comprador_orden === null) {
            if (removeUnicodeCharacters($comprador->user->email) === removeUnicodeCharacters($user->email)) {
                $tipo_firma = 'firma_comprador_orden';
            } else {
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del comprador: <br> <strong>'.$comprador->user->name.'</strong>');
            }
        } else {
            $tipo_firma = 'firma_final_aprobadores';
            $bandera = $this->bandera = false;
        }

        $organizacion = Organizacion::getFirst();
        $contrato = KatbolContrato::where('id', $requisicion->contrato_id)->first();

        $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisicion->id)->pluck('proveedor_id')->toArray();

        $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisicion->id)->first();

        $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

        return view('contract_manager.ordenes-compra.firmar', compact('requisicion', 'organizacion', 'bandera', 'contrato', 'comprador', 'tipo_firma', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto'));
    }
}
