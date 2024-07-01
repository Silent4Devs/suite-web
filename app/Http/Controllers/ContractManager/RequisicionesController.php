<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Mail\RequisicionesEmail;
use App\Mail\RequisicionesFirmaDuplicadaEmail;
use App\Models\ContractManager\Comprador as KatbolComprador;
use App\Models\ContractManager\Contrato as KatbolContrato;
use App\Models\ContractManager\ProvedorRequisicionCatalogo as KatbolProvedorRequisicionCatalogo;
use App\Models\ContractManager\ProveedorIndistinto as KatbolProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC as KatbolProveedorOC;
use App\Models\ContractManager\Requsicion as KatbolRequsicion;
use App\Models\ContractManager\Sucursal as KatbolSucursal;
use App\Models\Empleado;
use App\Models\FirmasRequisiciones;
use App\Models\ListaDistribucion;
use App\Models\Organizacion;
use App\Models\User;
use App\Models\User as ModelsUser;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use Symfony\Component\HttpFoundation\Response;

class RequisicionesController extends Controller
{
    use ObtenerOrganizacion;

    public $bandera = true;

    public $modelo = 'KatbolRequsicion';

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

        $id = User::getCurrentUser()->id;
        $roles = ModelsUser::find($id)->roles()->get();

        foreach ($roles as $rol) {
            if ($rol->title === 'Admin') {
                $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto', 'provedores_requisiciones', 'provedores_indistintos_requisiciones', 'provedores_requisiciones_catalogo')->orderByDesc('id')->where('archivo', false)->get();

                return view('contract_manager.requisiciones.index', compact('requisiciones', 'empresa_actual', 'logo_actual'));
            } else {
                $requisiciones_solicitante = null;
                $id = User::getCurrentUser()->id;

                $requisiciones_solicitante = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto', 'provedores_requisiciones', 'provedores_indistintos_requisiciones', 'provedores_requisiciones_catalogo')->where('archivo', false)->where('id_user', $id)->orderByDesc('id')->get();

                return view('contract_manager.requisiciones.index_solicitante', compact('requisiciones_solicitante', 'empresa_actual', 'logo_actual'));
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

            if (!$requisicion) {
                abort(404);
            }

            $organizacion = $this->obtenerOrganizacion();

            $supervisor = User::find($requisicion->id_user)->empleado->supervisor->name;

            $user = User::find($requisicion->id_finanzas);

            if ($user) {
                $firma_finanzas = $user->name;
            } else {
                $firma_finanzas = null;
            }

            $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisicion->id)->pluck('proveedor_id')->toArray();

            $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

            $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisicion->id)->first();

            return view('contract_manager.requisiciones.show', compact('requisicion', 'organizacion', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto', 'firma_finanzas'));
        } catch (\Exception $e) {
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
        abort_if(Gate::denies('katbol_requisiciones_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $requisiciondata = KatbolRequsicion::with('sucursal', 'comprador', 'contrato')->find($id);
        $organizacion = $this->obtenerOrganizacion();

        return view('contract_manager.requisiciones.edit', compact('requisiciondata', 'organizacion'));
    }

    /**
     * Update the specified resource in storage.
     *
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
            'zona' => 'required',
        ]);
        $sucursal = KatbolSucursal::find($id);

        $sucursal->update([
            'clave' => $request->clave,
            'descripcion' => $request->descripcion,
            'empresa' => $request->empresa,
            'cuenta_contable' => $request->cuenta_contable,
            'estado' => $request->estado,
            'zona' => $request->zona,
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
            $organizacion = Organizacion::getFirst();
            $contrato = KatbolContrato::where('id', $requisicion->contrato_id)->first();
            $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();

            $supervisor = User::find($requisicion->id_user)->empleado->supervisor->name;

            $user = User::find($requisicion->id_finanzas);

            if ($user) {
                $firma_finanzas_name = $user->name;
            } else {
                $firma_finanzas_name = null;
            }

            $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisicion->id)->pluck('proveedor_id')->toArray();

            $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisicion->id)->first();

            $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

            $alerta = $this->validacionLista($tipo_firma);

            return view('contract_manager.requisiciones.firmar', compact('requisicion', 'organizacion', 'contrato', 'comprador', 'tipo_firma', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto', 'firma_finanzas_name', 'alerta'));
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

        $copiasNivel = [];
        $responsablesAusentes = [];
        $correosCopia = [];

        if ($tipo_firma == 'firma_solicitante') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_solicitante_requi = $fecha;
            $requisicion->update([
                'estado' => 'curso',
            ]);
            $requisicion->save();
            //Buscamos supervisor
            $user = User::find($requisicion->id_user);
            $supervisor = $user->empleado->supervisor;

            //Buscamos modelo correspondiente a lideres
            $listaReq = ListaDistribucion::where('modelo', 'Empleado')->first();
            //Traemos participantes
            $listaPart = $listaReq->participantes;

            //Buscamos al supervisor por su id
            $supList = $listaPart->where('empleado_id', $supervisor->id)->first();

            //Buscamos en que nivel se encuentra el supervisor
            $nivel = $supList->nivel;

            //traemos a todos los participantes correspondientes a ese nivel
            $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

            //Buscamos 1 por 1 los participantes del nivel (area)
            foreach ($participantesNivel as $key => $partNiv) {
                //Si su estado esta activo se le manda el correo
                if ($partNiv->empleado->disponibilidad->disponibilidad == 1) {

                    $responsable = $partNiv->empleado;
                    $userEmail = $responsable->email;
                    break;
                }
            }

            $organizacion = Organizacion::getFirst();

            $firmas_requi = FirmasRequisiciones::updateOrCreate(
                [
                    'requisicion_id' => $requisicion->id,
                ],
                [
                    'solicitante_id' => $user->empleado->id,
                    'jefe_id' => $responsable->id,
                ]
                // 'responsable_finanzas_id' => $responsable->id,
                // 'comprador_id' => $comprador->user->empleado->id,
            );

            if ($responsable->id == $user->empleado->id) {
                Mail::to(trim($this->removeUnicodeCharacters($supervisor->email)))->queue(new RequisicionesFirmaDuplicadaEmail($requisicion, $organizacion, $tipo_firma));
            } else {
                Mail::to(trim($this->removeUnicodeCharacters($supervisor->email)))->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
            }
        }

        if ($tipo_firma == 'firma_jefe') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_jefe_requi = $fecha;
            $requisicion->save();

            $listaReq = ListaDistribucion::where('modelo', $this->modelo)->first();
            $listaPart = $listaReq->participantes;

            for ($i = 0; $i <= $listaReq->niveles; $i++) {
                $responsableNivel = $listaPart->where('nivel', $i)->where('numero_orden', 1)->first();

                if ($responsableNivel->empleado->disponibilidad->disponibilidad == 1) {

                    $responsable = $responsableNivel->empleado;
                    $userEmail = $responsable->email;

                    $cN = $listaPart->where('nivel', $i)->where('numero_orden', '!=', 1);

                    foreach ($cN as $key => $c) {
                        $copiasNivel[] = $c->empleado->email;
                    }

                    break;
                } else {
                    $responsablesAusentes[] = $responsableNivel->empleado->email;
                }
            }

            $correosCopia = array_merge($copiasNivel, $responsablesAusentes);

            $organizacion = Organizacion::getFirst();

            $firmas_requi = FirmasRequisiciones::updateOrCreate(
                [
                    'requisicion_id' => $requisicion->id,
                ],
                [
                    'responsable_finanzas_id' => $responsable->id,
                ]
                // 'comprador_id' => $comprador->user->empleado->id,
            );

            if ($responsable->id == $firmas_requi->jefe_id || $responsable->id == $firmas_requi->solicitante_id) {
                Mail::to(trim($this->removeUnicodeCharacters($userEmail)))->queue(new RequisicionesFirmaDuplicadaEmail($requisicion, $organizacion, $tipo_firma));
            } else {
                Mail::to(trim($this->removeUnicodeCharacters($userEmail)))->cc($correosCopia)->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
            }

            // Mail::to('ldelgadillo@silent4business.com')->cc('aurora.soriano@silent4business.com')->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
        }
        if ($tipo_firma == 'firma_finanzas') {

            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_finanzas_requi = $fecha;
            $user = User::getCurrentUser();
            $requisicion->id_finanzas = $user->id;
            $requisicion->save();
            $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();
            $userEmail = trim($this->removeUnicodeCharacters($comprador->user->email));

            $organizacion = Organizacion::getFirst();

            $firmas_requi = FirmasRequisiciones::updateOrCreate(
                [
                    'requisicion_id' => $requisicion->id,
                ],
                [
                    'comprador_id' => $comprador->user->empleado->id,
                ]
            );

            if ($comprador->user->empleado->id == $firmas_requi->responsable_finanzas_id || $comprador->user->empleado->id == $firmas_requi->jefe_id || $comprador->user->empleado->id == $firmas_requi->solicitante_id) {
                Mail::to(trim($this->removeUnicodeCharacters($userEmail)))->queue(new RequisicionesFirmaDuplicadaEmail($requisicion, $organizacion, $tipo_firma));
            } else {
                Mail::to(trim($this->removeUnicodeCharacters($userEmail)))->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
            }
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
            $organizacion = Organizacion::getFirst();
            Mail::to(removeUnicodeCharacters($userEmail))->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
        }

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
        $buttonSolicitante = false;
        $buttonJefe = false;
        $buttonFinanzas = false;
        $buttonCompras = false;

        $empleadoActual = User::getCurrentUser()->empleado;

        $LD = ListaDistribucion::where('modelo', $this->modelo)->first();
        $participantes = $LD->participantes;

        foreach ($participantes as $key => $participante) {
            if ($participante->empleado->disponibilidad->disponibilidad == 1 && $participante->empleado->id != $empleadoActual->id) {
                $sustitutosLD[] = $participante->empleado;
            }
        }

        return view('contract_manager.requisiciones.aprobadores', compact('requisiciones', 'proveedor_indistinto', 'buttonSolicitante', 'buttonJefe', 'buttonFinanzas', 'buttonCompras', 'empleadoActual', 'sustitutosLD'));
    }

    public function getRequisicionIndexAprobador()
    {
        $requisiciones = KatbolRequsicion::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto', 'registroFirmas')->where('archivo', false)->orderByDesc('id')->get();

        return datatables()->of($requisiciones)->toJson();
    }

    public function firmarAprobadores($id)
    {
        $alerta = false;
        $bandera = true;
        $requisicion = KatbolRequsicion::where('id', $id)->first();
        $user = User::find($requisicion->id_finanzas);
        $mensaje = null;

        if ($user) {
            $firma_finanzas_name = $user->name;
        } else {
            $firma_finanzas_name = null;
        }
        $user = User::getCurrentUser();
        $supervisor = User::find($requisicion->id_user)->empleado->supervisor->name;
        $supervisor_email = User::find($requisicion->id_user)->empleado->supervisor->email;
        $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();
        $solicitante = User::find($requisicion->id_user);

        $firma_siguiente = FirmasRequisiciones::where('requisicion_id', $requisicion->id)->first();

        if ($requisicion->firma_solicitante === null) {
            if ($user->empleado->id == $firma_siguiente->solicitante_id) { //solicitante_id
                $tipo_firma = 'firma_solicitante';
                $alerta = $this->validacionLista($tipo_firma);
            } else {
                $mensaje = 'No tiene permisos para firmar<br> En espera del solicitante directo: <br> <strong>' . $firma_siguiente->solicitante->name . '</strong>';
                return view('contract_manager.requisiciones.error', compact('mensaje'));
            }
        } elseif ($requisicion->firma_jefe === null) {
            if ($user->empleado->id == $firma_siguiente->jefe_id) { //jefe_id
                $tipo_firma = 'firma_jefe';
                $alerta = $this->validacionLista($tipo_firma);
            } else {
                $mensaje = 'No tiene permisos para firmar<br> En espera del jefe directo: <br> <strong>' . $firma_siguiente->jefe->name . '</strong>';
                return view('contract_manager.requisiciones.error', compact('mensaje'));
            }
        } elseif ($requisicion->firma_finanzas === null) {
            if ($user->empleado->id == $firma_siguiente->responsable_finanzas_id) { //responsable_finanzas_id
                $tipo_firma = 'firma_finanzas';
            } else {
                $mensaje = 'No tiene permisos para firmar<br> En espera de finanzas:' . $firma_siguiente->responsableFinanzas->name;
                return view('contract_manager.requisiciones.error', compact('mensaje'));
            }
        } elseif ($requisicion->firma_compras === null) {
            if (($user->empleado->id == $comprador->user->empleado->id) && ($user->empleado->id == $firma_siguiente->responsable_finanzas_id)) { //comprador_id
                $tipo_firma = 'firma_compras';
            } else {
                $mensaje = 'No tiene permisos para firmar<br> En espera del comprador: <br> <strong>' . $comprador->user->name . '</strong>';
                return view('contract_manager.requisiciones.error', compact('mensaje'));
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

        return view('contract_manager.requisiciones.firmar', compact('firma_siguiente', 'firma_finanzas_name', 'requisicion', 'organizacion', 'bandera', 'contrato', 'comprador', 'tipo_firma', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto', 'alerta'));
    }

    public function validacionLista($tipo)
    {
        $user = User::getCurrentUser();
        $alerta = false;
        $responsable = null;

        if ($tipo == "firma_solicitante") {
            $listaReq = ListaDistribucion::where('modelo', 'Empleado')->first();
            $listaPart = $listaReq->participantes;

            $jefe = $user->empleado->supervisor;
            $supList = $listaPart->where('empleado_id', $jefe->id)->first();

            $nivel = $supList->nivel;

            $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

            foreach ($participantesNivel as $key => $partNiv) {
                if ($partNiv->empleado->disponibilidad->disponibilidad == 1) {

                    $responsable = $partNiv->empleado;
                    $supervisor = $responsable->email;

                    break;
                }
            }
            $alerta = empty($responsable);
        } elseif ($tipo == "firma_jefe") {
            $listaReq = ListaDistribucion::where('modelo', $this->modelo)->first();
            $listaPart = $listaReq->participantes;

            for ($i = 0; $i <= $listaReq->niveles; $i++) {
                $responsableNivel = $listaPart->where('nivel', $i)->where('numero_orden', 1)->first();

                if ($responsableNivel->empleado->disponibilidad->disponibilidad == 1) {

                    $responsable = $responsableNivel->empleado;
                    $userEmail = $responsable->email;

                    break;
                }
            }
            $alerta = empty($responsable);
        }

        return $alerta;
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

        $userEmail = User::where('id', $requisicion->id_user)->first();
        $organizacion = Organizacion::getFirst();
        $tipo_firma = 'rechazado_requisicion';

        Mail::to(removeUnicodeCharacters($userEmail->email))->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));

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
        $user = User::find($requisiciones->id_finanzas);

        if ($user) {
            $firma_finanzas_name = $user->name;
        } else {
            $firma_finanzas_name = null;
        }

        $organizacion = Organizacion::getLogo();
        $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisiciones->id)->pluck('proveedor_id')->toArray();

        $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

        $supervisor = User::find($requisiciones->id_user)->empleado->supervisor->name;

        $proveedor_indistinto = KatbolProveedorIndistinto::where('requisicion_id', $requisiciones->id)->first();

        $pdf = PDF::loadView('requisiciones_pdf', compact('requisiciones', 'organizacion', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('requisicion.pdf');
    }

    public function filtrarPorEstado2()
    {
        $requisiciones = KatbolRequsicion::where('firma_solicitante', null)->get();
        $buttonSolicitante = true;
        $buttonJefe = false;
        $buttonFinanzas = false;
        $buttonCompras = false;
        toast('Filtro por solicitante aplicado!', 'success');

        return view('contract_manager.requisiciones.aprobadores', compact('requisiciones', 'buttonFinanzas', 'buttonSolicitante', 'buttonJefe', 'buttonCompras'));
    }

    public function filtrarPorEstado1()
    {
        $requisiciones = KatbolRequsicion::whereNotNull('firma_solicitante')->where('firma_jefe', null)->get();
        $buttonSolicitante = false;
        $buttonJefe = true;
        $buttonFinanzas = false;
        $buttonCompras = false;
        toast('Filtro por jefe aplicado!', 'success');

        return view('contract_manager.requisiciones.aprobadores', compact('requisiciones', 'buttonJefe', 'buttonSolicitante', 'buttonFinanzas', 'buttonCompras'));
    }

    public function filtrarPorEstado()
    {
        $requisiciones = KatbolRequsicion::whereNotNull('firma_solicitante')->whereNotNull('firma_jefe')->where('firma_finanzas', null)->get();
        $buttonSolicitante = false;
        $buttonJefe = false;
        $buttonFinanzas = true;
        $buttonCompras = false;
        toast('Filtro por finanzas aplicado!', 'success');

        return view('contract_manager.requisiciones.aprobadores', compact('requisiciones', 'buttonSolicitante', 'buttonJefe', 'buttonFinanzas', 'buttonCompras'));
    }

    public function filtrarPorEstado3()
    {
        $requisiciones = KatbolRequsicion::whereNotNull('firma_solicitante')->whereNotNull('firma_jefe')->whereNotNull('firma_finanzas')->where('firma_compras', null)->get();
        $buttonSolicitante = false;
        $buttonJefe = false;
        $buttonFinanzas = false;
        $buttonCompras = true;
        toast('Filtro por compras aplicado!', 'success');

        return view('contract_manager.requisiciones.aprobadores', compact('requisiciones', 'buttonCompras', 'buttonSolicitante', 'buttonJefe', 'buttonFinanzas'));
    }

    public function cambiarResponsable(Request $request)
    {
        try {
            $idEmpleadoActual = User::getCurrentUser()->empleado->id;

            $request->validate([
                'requisicion_id' => 'required',
                'nuevo_responsable' => 'required',
            ]);

            $requisicion = KatbolRequsicion::find($request->requisicion_id);
            $firmasRequisicion = $requisicion->registroFirmas;

            if ($firmasRequisicion->solicitante_id == $idEmpleadoActual) {
                $posicion = 'solicitante_id';
            }

            if ($firmasRequisicion->jefe_id == $idEmpleadoActual) {
                $posicion = 'jefe_id';
                $posicion_firma = 'firma_solicitante';
            }

            if ($firmasRequisicion->responsable_finanzas_id == $idEmpleadoActual) {
                $posicion = 'responsable_finanzas_id';
                $posicion_firma = 'firma_jefe';
            }

            if ($firmasRequisicion->comprador_id == $idEmpleadoActual) {
                $posicion = 'comprador_id';
                $posicion_firma = 'firma_finanzas';
            }

            $nuevoResponsableId = $request->nuevo_responsable;
            $emailNuevoResponsable = Empleado::find($nuevoResponsableId);

            $firmasRequisicion->update([
                $posicion => $nuevoResponsableId,
            ]);

            $organizacion = Organizacion::getFirst();

            Mail::to(trim($this->removeUnicodeCharacters($emailNuevoResponsable->email)))->queue(new RequisicionesEmail($requisicion, $organizacion, $posicion_firma));

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
