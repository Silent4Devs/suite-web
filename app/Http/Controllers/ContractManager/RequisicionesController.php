<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Mail\RequisicionesEmail;
use App\Models\ContractManager\Comprador as KatbolComprador;
use App\Models\ContractManager\Contrato as KatbolContrato;
use App\Models\ContractManager\ProvedorRequisicionCatalogo as KatbolProvedorRequisicionCatalogo;
use App\Models\ContractManager\ProveedorIndistinto as KatbolProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC as KatbolProveedorOC;
use App\Models\ContractManager\Requsicion as KatbolRequsicion;
use App\Models\ContractManager\Sucursal as KatbolSucursal;
use App\Models\Organizacion;
use App\Models\User;
use App\Models\User as ModelsUser;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;
use Symfony\Component\HttpFoundation\Response;

class RequisicionesController extends Controller
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
        abort_if(Gate::denies('katbol_requisiciones_acceso'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        $proveedor_indistinto = KatbolProveedorIndistinto::pluck('requisicion_id')->first();

        $requisicion_id = KatbolRequsicion::get()->pluck('id');
        $ids = [];

        foreach ($requisicion_id as $id) {
            $ids = $id;
        }

        $id = Auth::user()->id;
        $roles = ModelsUser::find($id)->roles()->get();

        foreach ($roles as $rol) {
            if ($rol->title === 'Admin') {
                $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->orderByDesc('id')->where('archivo', false)->get();
                return view('contract_manager.requisiciones.index', compact('ids', 'requisiciones', 'proveedor_indistinto', 'empresa_actual', 'logo_actual'));
            } else {
                $requisiciones_solicitante = null;
                $id = User::getCurrentUser()->id;

                $requisiciones_solicitante = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', false)->where('id_user', $id)->orderByDesc('id')->get();
                return view('contract_manager.requisiciones.index_solicitante', compact('ids', 'requisiciones_solicitante', 'empresa_actual', 'logo_actual', 'proveedor_indistinto'));
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
        abort_if(Gate::denies('katbol_requisiciones_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sucursales = KatbolSucursal::get();
        $compradores = KatbolComprador::get();
        $contratos = KatbolContrato::with('proveedor')->get();

        return view('contract_manager.requisiciones.create', compact('sucursales', 'compradores', 'contratos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eliminarProveedores()
    {
        //codigo
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
            $requisicion = KatbolRequsicion::with('sucursal', 'comprador.user', 'contrato')->find($id);
            $organizacion = $this->obtenerOrganizacion();

            $supervisor = $usuario = User::getCurrentUser()->empleado->supervisor->name;
            $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisicion->id)->pluck('proveedor_id')->toArray();

            $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

            $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisicion->id)->first();

            return view('contract_manager.requisiciones.show', compact('requisicion', 'organizacion', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto'));
        } catch (\Exception $e) {
            return view('contract_manager.requisiciones.error');
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
        abort_if(Gate::denies('katbol_requisiciones_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $requisiciondata = KatbolRequsicion::with('sucursal', 'comprador', 'contrato')->find($id);
        $organizacion = $this->obtenerOrganizacion();

        return view('contract_manager.requisiciones.edit', compact('requisiciondata', 'organizacion'));
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
        $request->validate([
            'clave' => 'required',
            'descripcion' => 'required',
            'empresa' => 'required',
            'cuenta_contable' => 'required',
            'estado' => 'required',
            'zona' =>  'required',
        ]);
        $sucursal = KatbolSucursal::find($id);

        $sucursal->update([
            'clave' => $request->clave,
            'descripcion' => $request->descripcion,
            'empresa' => $request->empresa,
            'cuenta_contable' => $request->cuenta_contable,
            'estado' => $request->estado,
            'zona' =>  $request->zona,
        ]);

        return redirect()->route('catalogos');
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

        return redirect(route('contract_manager.requisiciones'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Firmar($tipo_firma, $id)
    {
        try {
            $requisicion = KatbolRequsicion::where('id', $id)->first();
            $organizacion = Organizacion::first();
            $contrato = KatbolContrato::where('id', $requisicion->contrato_id)->first();
            $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();

            $supervisor = User::getCurrentUser()->empleado->supervisor->name;

            $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisicion->id)->pluck('proveedor_id')->toArray();

            $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisicion->id)->first();

            $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

            return view('contract_manager.requisiciones.firmar', compact('requisicion', 'organizacion', 'contrato', 'comprador', 'tipo_firma', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto'));
        } catch (\Exception $e) {
            return view('contract_manager.requisiciones.error');
        }
    }

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function FirmarUpdate(Request $request, $tipo_firma, $id)
    {
        $request->validate([
            'firma' => 'required',
        ]);

        $requisicion = KatbolRequsicion::find($id);
        $requisicion->update([
            $tipo_firma => $request->firma,
        ]);

        if ($tipo_firma == 'firma_jefe') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_jefe_requi = $fecha;
            $requisicion->save();
            $userEmail = 'lourdes.abadia@silent4business.com';
        }
        if ($tipo_firma == 'firma_finanzas') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_finanzas_requi = $fecha;
            $requisicion->save();
            $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();
            $userEmail = trim($this->removeUnicodeCharacters($comprador->user->email));
        }
        if ($tipo_firma == 'firma_compras') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_comprador_requi = $fecha;
            $requisicion->save();

            // correo de compras
            $userEmail = $requisicion->email;
            $requisicion->update([
                'estado' => 'firmada',
            ]);
        }
        $organizacion = Organizacion::first();
        Mail::to($userEmail)->send(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));

        return redirect(route('contract_manager.requisiciones'));
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function archivo()
    {
        $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', true)->get();
        $proveedor_indistinto = KatbolProveedorIndistinto::pluck('requisicion_id')->first();

        return view('contract_manager.requisiciones.archivo', compact('requisiciones', 'proveedor_indistinto'));
    }

    public function indexAprobadores()
    {
        $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', false)->orderByDesc('id')->get();
        $proveedor_indistinto = KatbolProveedorIndistinto::pluck('requisicion_id')->first();

        return view('contract_manager.requisiciones.aprobadores', compact('requisiciones', 'proveedor_indistinto'));
    }

    public function getRequisicionIndexAprobador()
    {
        $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', false)->orderByDesc('id')->get();

        return datatables()->of($requisiciones)->toJson();
    }

    public function firmarAprobadores($id)
    {
        $bandera = true;
        $requisicion = KatbolRequsicion::where('id', $id)->first();
        if ($requisicion->firma_solicitante === null) {
            $tipo_firma = 'firma_solicitante';
        } elseif ($requisicion->firma_jefe === null) {
            $tipo_firma = 'firma_jefe';
        } elseif ($requisicion->firma_finanzas === null) {
            $tipo_firma = 'firma_finanzas';
        } elseif ($requisicion->firma_compras === null) {
            $tipo_firma = 'firma_compras';
        } else {
            $tipo_firma = 'firma_final_aprobadores';
            $bandera = $this->bandera = false;
        }

        $organizacion = Organizacion::first();
        $contrato = KatbolContrato::where('id', $requisicion->contrato_id)->first();
        $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();

        $supervisor = User::getCurrentUser()->empleado->supervisor->name;

        $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisicion->id)->pluck('proveedor_id')->toArray();

        $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisicion->id)->first();

        $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

        return view('contract_manager.requisiciones.firmar', compact('requisicion', 'organizacion', 'bandera', 'contrato', 'comprador', 'tipo_firma', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto'));
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function estado($id)
    {
        $requisicion = KatbolRequsicion::find($id);
        if ($requisicion->archivo === false) {
            $requisicion->update([
                'archivo' => true,
            ]);
        } else {
            $requisicion->update([
                'archivo' => false,
            ]);
        }

        $requisiciones = KatbolRequsicion::where('archivo', true)->get();
        $proveedor_indistinto = KatbolProveedorIndistinto::pluck('requisicion_id')->first();

        return view('contract_manager.requisiciones.archivo', compact('requisiciones', 'proveedor_indistinto'));
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
            'estado' => 'rechazado',
            'firma_solicitante' => null,
            'firma_jefe' => null,
            'firma_finanzas' => null,
            'firma_compras' => null,
        ]);

        $userEmail = Auth::user()->email;
        $organizacion = Organizacion::first();
        $tipo_firma = 'rechazado_requisicion';
        Mail::to($requisicion->email)->send(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));

        return redirect(route('contract_manager.requisiciones'));
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto')->where('archivo', false)->find($id);
        $organizacion = Organizacion::select('empresa', 'logotipo')->first();
        $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisiciones->id)->pluck('proveedor_id')->toArray();

        $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

        $supervisor = User::getCurrentUser()->empleado->supervisor->name;

        $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisiciones->id)->first();

        $pdf = PDF::loadView('requisiciones_pdf', compact('requisiciones', 'organizacion', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('requisicion.pdf');
    }
}