<?php

namespace App\Http\Controllers\Katbol;

use App\Mail\RequisicionesEmail;
use App\Models\Organizacion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Katbol\Comprador as KatbolComprador;
use App\Models\Katbol\Contrato as KatbolContrato;
use App\Models\Katbol\ProvedorRequisicionCatalogo as KatbolProvedorRequisicionCatalogo;
use App\Models\Katbol\ProveedorIndistinto as KatbolProveedorIndistinto;
use App\Models\Katbol\ProveedorOC as KatbolProveedorOC;
use App\Models\Katbol\Requsicion as KatbolRequsicion;
use App\Models\Katbol\Sucursal as KatbolSucursal;
use App\Models\User as ModelsUser;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RequisicionesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal','productos_requisiciones.producto')->orderByDesc('id')->where('archivo', false)->get();
        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo_katbol.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }

        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        $requisiciones_solicitante=null;
        $id = Auth::user()->id;

        $requisiciones_solicitante=KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal','productos_requisiciones.producto')->where('archivo', false)->where('id_user', $id)->orderByDesc('id')->get();

        $proveedor_indistinto = KatbolProveedorIndistinto::pluck('requisicion_id')->first();

        $requisicion_id = KatbolRequsicion::get()->pluck('id');
        $ids = [];

        foreach ($requisicion_id as $id) {
            $ids =  $id;
        }


        $id = Auth::user()->id;
        $roles = ModelsUser::find($id)->roles()->get();
        foreach ($roles as $rol) {
            if($rol->name === 'Admin'){
                return view('katbol.requisiciones.index', compact('ids', 'requisiciones', 'proveedor_indistinto', 'empresa_actual', 'logo_actual'));
            }else{

                return view('katbol.requisiciones.index_solicitante', compact('ids', 'requisiciones_solicitante', 'empresa_actual', 'logo_actual', 'proveedor_indistinto'));
            }
        }


    }


    public function getRequisicionIndex(Request $request)
    {
        $requisiciones_solicitante=KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal','productos_requisiciones.producto')->where('archivo', false)->orderByDesc('id')->get();

        return datatables()->of($requisiciones_solicitante)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = KatbolSucursal::get();
        $compradores = KatbolComprador::get();
        $contratos = KatbolContrato::with('proveedor')->get();

        return view('katbol.requisiciones.create', compact('sucursales', 'compradores', 'contratos'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $requisicion = KatbolRequsicion::with('sucursal', 'comprador.user', 'contrato')->find($id);
        $organizacion = Organizacion::select('empresa', 'logotipo')->first();

        $user = ModelsUser::where('id',  $requisicion->id_user)->first();

        $empleado = Empleado::with('supervisor')->where('id',  $user->empleado_tabantaj_id)->first();

        $supervisor = $empleado->supervisor->name;
        $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisicion->id)->pluck('proveedor_id')->toArray();

        $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

        $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisicion->id)->first();

        return view('katbol.requisiciones.show', compact('requisicion','organizacion', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $requisiciondata = KatbolRequsicion::with('sucursal', 'comprador', 'contrato')->find($id);
            $organizacion = Organizacion::select('empresa', 'logotipo')->first();

            return view('katbol.requisiciones.edit', compact('requisiciondata', 'organizacion'));
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
    public function Firmar($tipo_firma, $id)
    {

           $requisicion = KatbolRequsicion::where('id', $id)->first();
           $organizacion = Organizacion::first();
           $contrato = KatbolContrato::where('id',$requisicion->contrato_id)->first();
           $comprador = KatbolComprador::with('user')->where('id',$requisicion->comprador_id)->first();
           $user = ModelsUser::where('id',  $requisicion->id_user)->first();

           $empleado = Empleado::with('supervisor')->where('id',  $user->empleado_id)->first();

           $supervisor = $empleado->supervisor->name;

           $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisicion->id)->pluck('proveedor_id')->toArray();

           $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisicion->id)->first();

           $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

           return view('requisiciones.firmar', compact('requisicion', 'organizacion', 'contrato', 'comprador', 'tipo_firma', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto'));
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

            if($tipo_firma == 'firma_jefe'){
                $fecha =  date('d-m-Y');
                $requisicion->fecha_firma_jefe_requi =  $fecha;
                $requisicion->save();
                $userEmail = 'lourdes.abadia@silent4business.com';


            }
            if($tipo_firma == 'firma_finanzas'){
                $fecha =  date('d-m-Y');
                $requisicion->fecha_firma_finanzas_requi =  $fecha;
                $requisicion->save();
                $comprador = KatbolComprador::where('id', $requisicion->comprador_id)->first();
                $userEmail = $comprador->user->email;
            }
            if($tipo_firma == 'firma_compras'){
                $fecha =  date('d-m-Y');
                $requisicion->fecha_firma_comprador_requi =  $fecha;
                $requisicion->save();

                // correo de compras
                $userEmail = $requisicion->email;
                $requisicion->update([
                     'estado'=>'firmada'
                ]);
            }
            $organizacion = Organizacion::first();
            Mail::to($userEmail)->send(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
            return redirect(route('requisiciones'));

    }

         /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function archivo()
    {
      $requisiciones = KatbolRequsicion::where('archivo', true)->get();

      return view('katbol.requisiciones.archivo', compact('requisiciones'));
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
        if($requisicion->archivo === false){
            $requisicion->update([
                'archivo' => true,
            ]);

        }else{
            $requisicion->update([
                'archivo' => false,
            ]);
        }
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
        return redirect(route('requisiciones'));

    }



      /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {

        $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal','productos_requisiciones.producto')->where('archivo', false)->find($id);
        $organizacion = Organizacion::select('empresa', 'logotipo')->first();
        $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisiciones->id)->pluck('proveedor_id')->toArray();

        $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

        $user = ModelsUser::where('id',  $requisiciones->id_user)->first();

        $empleado = Empleado::with('supervisor')->where('id',  $user->empleado_tabantaj_id)->first();

        $supervisor = $empleado->supervisor->name;

        $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisiciones->id)->first();

        $pdf = PDF::loadView('requisiciones_pdf', compact('requisiciones', 'organizacion', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf-> download('requisicion.pdf');
    }
}
