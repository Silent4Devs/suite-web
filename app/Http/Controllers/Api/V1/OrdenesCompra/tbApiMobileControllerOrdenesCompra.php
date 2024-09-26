<?php

namespace App\Http\Controllers\Api\V1\OrdenesCompra;

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
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use Symfony\Component\HttpFoundation\Response;

class tbApiMobileControllerOrdenesCompra extends Controller
{
    use ObtenerOrganizacion;

    public $bandera = true;

    public $modelo = 'KatbolRequsicion';

    public function encodeSpecialCharacters($url)
    {
        // Handle spaces
        // $url = str_replace(' ', '%20', $url);
        // Encode other special characters, excluding /, \, and :
        $url = preg_replace_callback(
            '/[^A-Za-z0-9_\-\.~\/\\\:]/',
            function ($matches) {
                return rawurlencode($matches[0]);
            },
            $url,
        );
        return $url;
    }

    public function index()
    {
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;
        $user = User::getCurrentUser();

        if ($user->roles->contains('title', 'Admin') || $user->can('visualizar_todas_requisicion')) {
            $ordenes_compra = KatbolRequsicion::getOCAll();

            foreach ($ordenes_compra as $keyOrd => $orden_compra) {
                if($orden_compra->id_user != null){

                    if ($orden_compra->proveedor_catalogo_oc === null || typeOf($orden_compra->proveedor_catalogo_oc) === 'undefined') {
                        // Verifica si 'proveedores_requisiciones' está definido y tiene al menos un contacto
                        if ($orden_compra->proveedores_requisiciones && !empty($orden_compra->proveedores_requisiciones)) {
                            $proveedor = $orden_compra->proveedores_requisiciones[0]->contacto;
                        } else {
                            $proveedor = 'Pendiente';
                        }
                    } else {
                        $proveedor = $orden_compra->proveedor_catalogo_oc; // Valor no es null ni undefined
                    }

                    $estado = null;

                    if ($orden_compra->estatus == "rechazado_oc") {
                        $estado ="Rechazado";
                    } else {
                        if (!$orden_compra->firma_solicitante && !$orden_compra->firma_comprador && !$orden_compra->firma_finanzas) {
                            $estado = "Por iniciar";
                        } else if ($orden_compra->firma_solicitante && $orden_compra->firma_comprador && $orden_compra->firma_finanzas) {
                            $estado = "Firmada";
                        } else {
                            $estado = "En curso";
                        }
                    }

                    $user = User::find($orden_compra->id_user);

                    // Validar si el usuario tiene relación empleado
                    if ($user && $user->empleado) {
                        $empleado = $user->empleado;
                    } else {
                        $empleado = null; // O asignar valores predeterminados aquí
                    }

                    $json_orden[$keyOrd] = [
                        "folio" => $orden_compra->folio,
                        "fecha" => $orden_compra->fecha,
                        "referencia" => $orden_compra->referencia,
                        "estatus" => $estado,
                        "proveedor_catalogo_oc" => $proveedor,
                        "no_contrato" => $orden_compra->contrato->no_contrato ?? "Campo Vacío",
                        "nombre_servicio" => $orden_compra->contrato->nombre_servicio ?? "Campo Vacío",
                        "area" => $orden_compra->area,
                        "user" => $orden_compra->user,
                        // "sub_total" => $orden_compra->sub_total,
                        // "iva" => $orden_compra->iva,
                        // "total" => $orden_compra->total,
                    ];
                }
            }

            return response(json_encode([
                'ordenCompra' => $json_orden,
            ]), 200)->header('Content-Type', 'application/json');
        } else {
            $ordenes_compra_solicitante = KatbolRequsicion::getOCAll()->where('id_user', $user->id);

            foreach ($ordenes_compra_solicitante as $keyOrd => $orden_compra) {
                if($orden_compra->id_user != null){

                    if ($orden_compra->proveedor_catalogo_oc === null || typeOf($orden_compra->proveedor_catalogo_oc) === 'undefined') {
                        // Verifica si 'proveedores_requisiciones' está definido y tiene al menos un contacto
                        if ($orden_compra->proveedores_requisiciones && !empty($orden_compra->proveedores_requisiciones)) {
                            $proveedor = $orden_compra->proveedores_requisiciones[0]->contacto;
                        } else {
                            $proveedor = 'Pendiente';
                        }
                    } else {
                        $proveedor = $orden_compra->proveedor_catalogo_oc; // Valor no es null ni undefined
                    }

                    $estado = null;

                    if ($orden_compra->estatus == "rechazado_oc") {
                        $estado ="Rechazado";
                    } else {
                        if (!$orden_compra->firma_solicitante && !$orden_compra->firma_comprador && !$orden_compra->firma_finanzas) {
                            $estado = "Por iniciar";
                        } else if ($orden_compra->firma_solicitante && $orden_compra->firma_comprador && $orden_compra->firma_finanzas) {
                            $estado = "Firmada";
                        } else {
                            $estado = "En curso";
                        }
                    }

                    $json_orden[$keyOrd] = [
                        "folio" => $orden_compra->folio,
                        "fecha" => $orden_compra->fecha,
                        "referencia" => $orden_compra->referencia,
                        "estatus" => $estado,
                        "proveedor_catalogo_oc" => $proveedor,
                        "no_contrato" => $orden_compra->contrato->no_contrato ?? "Campo Vacío",
                        "nombre_servicio" => $orden_compra->contrato->nombre_servicio ?? "Campo Vacío",
                        "area" => $orden_compra->area,
                        "user" => $orden_compra->user,
                        // "sub_total" => $orden_compra->sub_total,
                        // "iva" => $orden_compra->iva,
                        // "total" => $orden_compra->total,
                    ];
                }
                }

                return response(json_encode([
                    'ordenCompra' => $json_orden,
                ]), 200)->header('Content-Type', 'application/json');
        }
    }

    public function firmarAprobadores($id)
    {
        $bandera = true;
        $requisicion = KatbolRequsicion::getOCAll()->where('id', $id)->first();

        $user = User::getCurrentUser();
        $supervisor = User::find($requisicion->id_user)->empleado->supervisor->name;
        $supervisor_email = User::find($requisicion->id_user)->empleado->supervisor->email;
        $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();
        $solicitante = User::find($requisicion->id_user);

        if ($requisicion->firma_comprador_orden === null) {
            if (removeUnicodeCharacters($comprador->user->email) === removeUnicodeCharacters($user->email)) {
                $tipo_firma = 'firma_comprador_orden';
            } else {
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del comprador directo: <br> <strong>' . $comprador->user->name . '</strong>');
            }
        } elseif ($requisicion->firma_solicitante_orden === null) {
            if (removeUnicodeCharacters($user->email) === removeUnicodeCharacters($solicitante->email)) {
                $tipo_firma = 'firma_solicitante_orden';
            } else {
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del solicitante directo: <br> <strong>' . $solicitante->name . '</strong>');
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
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del comprador: <br> <strong>' . $comprador->user->name . '</strong>');
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

        if ($requisicion->firma_solicitante === null && $requisicion->estado != 'rechazado') {
            if ($firma_siguiente && isset($firma_siguiente->solicitante_id)) {
                if ($user->empleado->id == $firma_siguiente->solicitante_id) { //solicitante_id
                    $tipo_firma = 'firma_solicitante';
                    $alerta = $this->validacionLista($tipo_firma);
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera del solicitante directo:' . $firma_siguiente->solicitante->name . '';

                    return response(json_encode([
                        'requisicion' => $mensaje,
                    ]), 200)->header('Content-Type', 'application/json');
                }
            } else {

                $$responsable = User::find($requisicion->id_user)->empleado;

                if ($user->empleado->id == $responsable->id) {
                    $tipo_firma = 'firma_solicitante';
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera del solicitante directo';

                    return response(json_encode([
                        'requisicion' => $mensaje,
                    ]), 200)->header('Content-Type', 'application/json');
                }
            }
        } elseif ($requisicion->firma_jefe === null && $requisicion->estado != 'rechazado') {
            if ($firma_siguiente && isset($firma_siguiente->jefe_id)) {
                if ($user->empleado->id == $firma_siguiente->jefe_id) { //jefe_id
                    $tipo_firma = 'firma_jefe';
                    $alerta = $this->validacionLista($tipo_firma);
                } else {
                    $mensaje = 'No tiene permisos para firmar. En espera del jefe directo:' . $firma_siguiente->jefe->name . '';
                    return response(json_encode([
                        'requisicion' => $mensaje,
                    ]), 200)->header('Content-Type', 'application/json');
                }
            } else {
                $listaReq = ListaDistribucion::where('modelo', 'Empleado')->first();
                $listaPart = $listaReq->participantes;

                $jefe = $user->empleado->supervisor;
                $supList = $listaPart->where('empleado_id', $jefe->id)->first();

                $nivel = $supList->nivel;

                $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

                foreach ($participantesNivel as $key => $partNiv) {
                    if ($partNiv->empleado->disponibilidad->disponibilidad == 1) {

                        $responsable = $partNiv->empleado;

                        break;
                    }
                }

                if ($user->empleado->id == $responsable->id) {
                    $tipo_firma = 'firma_jefe';
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera del jefe directo';

                    return response(json_encode([
                        'requisicion' => $mensaje,
                    ]), 200)->header('Content-Type', 'application/json');
                }
            }
        } elseif ($requisicion->firma_finanzas === null && $requisicion->estado != 'rechazado') {
            if ($firma_siguiente && isset($firma_siguiente->responsable_finanzas_id)) {
                if ($user->empleado->id == $firma_siguiente->responsable_finanzas_id) { //responsable_finanzas_id
                    $tipo_firma = 'firma_finanzas';
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera de finanzas:' . $firma_siguiente->responsableFinanzas->name;

                    return response(json_encode([
                        'requisicion' => $mensaje,
                    ]), 200)->header('Content-Type', 'application/json');
                }
            } else {
                $listaReq = ListaDistribucion::where('modelo', $this->modelo)->first();
                $listaPart = $listaReq->participantes;

                for ($i = 0; $i <= $listaReq->niveles; $i++) {
                    $responsableNivel = $listaPart->where('nivel', $i)->where('numero_orden', 1)->first();

                    if ($responsableNivel->empleado->disponibilidad->disponibilidad == 1) {

                        $responsable = $responsableNivel->empleado;

                        break;
                    }
                }
                if ($user->empleado->id == $responsable->id) {
                    $tipo_firma = 'firma_finanzas';
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera del responsable de finanzas';

                    return response(json_encode([
                        'requisicion' => $mensaje,
                    ]), 200)->header('Content-Type', 'application/json');
                }
            }
        } elseif ($requisicion->firma_compras === null && $requisicion->estado != 'rechazado') {
            if ($firma_siguiente && isset($firma_siguiente->comprador_id)) {
                if (($user->empleado->id == $comprador->user->id) && ($user->empleado->id == $firma_siguiente->comprador_id)) { //comprador_id
                    $tipo_firma = 'firma_compras';
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera del comprador:' . $comprador->user->name . '';

                    return response(json_encode([
                        'requisicion' => $mensaje,
                    ]), 200)->header('Content-Type', 'application/json');
                }
            } else {
                if (($user->empleado->id == $comprador->user->id)) { //comprador_id
                    $tipo_firma = 'firma_compras';
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera del comprador:' . $comprador->user->name . '';

                    return response(json_encode([
                        'requisicion' => $mensaje,
                    ]), 200)->header('Content-Type', 'application/json');
                }
            }
        } elseif($requisicion->estado != 'rechazado') {
            $tipo_firma = 'firma_final_aprobadores';
            $bandera = $this->bandera = false;
        }else{
            $mensaje = 'Esta requisición ya ha sido rechazada';

            return response(json_encode([
                'requisicion' => $mensaje,
            ]), 200)->header('Content-Type', 'application/json');
        }

        $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisicion->id)->pluck('proveedor_id')->toArray();

        $proveedores_indistintos = KatbolProveedorIndistinto::where('requisicion_id', $requisicion->id)->get();

        $proveedores_catalogo = KatbolProveedorOC::whereIn('id', $proveedores_show)->get();

        $imagen_logo = $this->encodeSpecialCharacters($requisicion->sucursal->mylogo);

        $json_requisicion['tipo_firma'] = [
            'tipo_firma' => $tipo_firma,
        ];

        $json_requisicion['alerta'] = [
            'alerta' => $alerta,
        ];

        $json_requisicion['general'] = [
            'fecha' => date('d-m-Y', strtotime($requisicion->fecha)),
            'referencia' => $requisicion->referencia,
            'area' => $requisicion->area,
            'nombre_comprador' => $comprador->user->name,
            'nombre_solicitante' => $requisicion->user,
        ];

        $json_requisicion['contrato'] = [
            'no_proyecto' => $requisicion->contrato->no_proyecto ?? '',
            'no_contrato' => $requisicion->contrato->no_contrato ?? '',
            'nombre_servicio' => $requisicion->contrato->nombre_servicio ?? '',
        ];

        $json_requisicion['comprador'] = [
            'no_proyecto' => $requisicion->contrato->no_proyecto ?? '',
            'no_contrato' => $requisicion->contrato->no_contrato ?? '',
            'nombre_servicio' => $requisicion->contrato->nombre_servicio ?? '',
        ];

        $json_requisicion['info_sucursal'] = [
            'empresa' => $requisicion->sucursal->empresa,
            'rfc' => $requisicion->sucursal->rfc,
            'direccion' => $requisicion->sucursal->direccion,
            'url_foto_empresa' => 'razon_social/' . $imagen_logo,
        ];

        foreach ($requisicion->productos_requisiciones as $producto) {
            $json_requisicion['productos'][] = [
                'cantidad_producto' => $producto->cantidad ?? '',
                'descripcion_producto' => $producto->producto->descripcion ?? '',
                'espesificaciones_producto' => $producto->espesificaciones ?? '',
            ];
        }

        foreach ($requisicion->provedores_requisiciones as $proveedor) {
            $json_requisicion['proveedor_sugerido'][] = [
                'nombre_proveedor' => $proveedor->proveedor,
                'detalles_proveedor' => $proveedor->detalles,
                'comentarios_proveedor' => $proveedor->comentarios,
                'contacto_proveedor' => $proveedor->contacto,
                'fechaInicio_proveedor' => date('d-m-Y', strtotime($proveedor->fecha_inicio)),
                'telefono_proveedor' => $proveedor->cel,
                'correo_proveedor' => $proveedor->contacto_correo,
                'fechaFin_proveedor' => date('d-m-Y', strtotime($proveedor->fecha_fin)),
                'url_proveedor' => $proveedor->url,
            ];
        }


        if ($requisicion->proveedor_catalogo != null) {
            foreach ($proveedores_catalogo as $prov) {
                $json_requisicion['proveedor'][] =             [
                    'nombre_proveedor' => $prov->nombre ?? '',
                    'empresa_proveedor' => $prov->razon_social ?? '',
                    'rfc_proveedor' => $prov->rfc,
                    'contacto_proveedor' => $prov->contacto,
                    'fechaInicio_proveedor' => date('d-m-Y', strtotime($prov->fecha_inicio)) ?? 'La fecha de inicio no está disponible.',
                    'fechaFin_proveedor' => date('d-m-Y', strtotime($prov->fecha_fin)) ?? 'La fecha fin no está disponible.',
                ];
            }
        }

        if (!empty($proveedores_indistintos)) {
            foreach ($proveedores_indistintos as $prov) {
                $json_requisicion['proveedor_indistinto'][] =             [
                    'fechaInicio_proveedor' => date('d-m-Y', strtotime($prov->fecha_inicio)) ?? 'La fecha de inicio no está disponible.',
                    'fechaFin_proveedor' => date('d-m-Y', strtotime($prov->fecha_fin)) ?? 'La fecha fin no está disponible.',
                ];
            }
        }

        return response(json_encode([
            'requisicion' => $json_requisicion,
        ]), 200)->header('Content-Type', 'application/json');
        // return view('contract_manager.requisiciones.firmar', compact('firma_siguiente', 'firma_finanzas_name', 'requisicion', 'organizacion', 'bandera', 'contrato', 'comprador', 'tipo_firma', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto', 'alerta'));
    }

    public function firmarAprobadores($id)
    {
        $bandera = true;
        $requisicion = KatbolRequsicion::getOCAll()->where('id', $id)->first();

        $user = User::getCurrentUser();
        $supervisor = User::find($requisicion->id_user)->empleado->supervisor->name;
        $supervisor_email = User::find($requisicion->id_user)->empleado->supervisor->email;
        $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();
        $solicitante = User::find($requisicion->id_user);

        if ($requisicion->firma_comprador_orden === null) {
            if (removeUnicodeCharacters($comprador->user->email) === removeUnicodeCharacters($user->email)) {
                $tipo_firma = 'firma_comprador_orden';
            } else {
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del comprador directo: <br> <strong>' . $comprador->user->name . '</strong>');
            }
        } elseif ($requisicion->firma_solicitante_orden === null) {
            if (removeUnicodeCharacters($user->email) === removeUnicodeCharacters($solicitante->email)) {
                $tipo_firma = 'firma_solicitante_orden';
            } else {
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del solicitante directo: <br> <strong>' . $solicitante->name . '</strong>');
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
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del comprador: <br> <strong>' . $comprador->user->name . '</strong>');
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

    public function validacionLista($tipo)
    {
        $user = User::getCurrentUser();
        $alerta = false;
        $responsable = null;

        if ($tipo == 'firma_solicitante') {
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
        } elseif ($tipo == 'firma_jefe') {
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

    public function FirmarUpdate(Request $request, $id)
    {

try {
    $request->validate([
        'firma' => 'required',
        'tipo_firma'=> 'required',
    ]);

    $requisicion = KatbolRequsicion::find($id);
    $requisicion->update([
        $request->tipo_firma => $request->firma,
    ]);

    $copiasNivel = [];
    $responsablesAusentes = [];
    $correosCopia = [];

    if ($request->tipo_firma == 'firma_solicitante') {
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
            Mail::to(trim($this->removeUnicodeCharacters($supervisor->email)))->queue(new RequisicionesFirmaDuplicadaEmail($requisicion, $organizacion, $request->tipo_firma));
        } else {
            Mail::to(trim($this->removeUnicodeCharacters($supervisor->email)))->queue(new RequisicionesEmail($requisicion, $organizacion, $request->tipo_firma));
        }
    }

    if ($request->tipo_firma == 'firma_jefe') {
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

        $solicitante = User::find($requisicion->id_user);

        $firmas_requi = FirmasRequisiciones::updateOrCreate(
            [
                'requisicion_id' => $requisicion->id,
            ],
            [
                'solicitante_id' => $solicitante->empleado->id,
                'responsable_finanzas_id' => $responsable->id,
            ]
        );

        if ($responsable->id == $firmas_requi->jefe_id || $responsable->id == $firmas_requi->solicitante_id) {
            Mail::to(trim($this->removeUnicodeCharacters($userEmail)))->queue(new RequisicionesFirmaDuplicadaEmail($requisicion, $organizacion, $request->tipo_firma));
        } else {
            Mail::to(trim($this->removeUnicodeCharacters($userEmail)))->cc($correosCopia)->queue(new RequisicionesEmail($requisicion, $organizacion, $request->tipo_firma));
        }
    }
    if ($request->tipo_firma == 'firma_finanzas') {

        $fecha = date('d-m-Y');
        $requisicion->fecha_firma_finanzas_requi = $fecha;
        $user = User::getCurrentUser();
        $requisicion->id_finanzas = $user->id;
        $requisicion->save();
        $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();
        $userEmail = trim($this->removeUnicodeCharacters($comprador->user->email));

        $solicitante = User::find($requisicion->id_user);

        $organizacion = Organizacion::getFirst();

        $firmas_requi = FirmasRequisiciones::updateOrCreate(
            [
                'requisicion_id' => $requisicion->id,
            ],
            [
                'solicitante_id' => $solicitante->empleado->id,
                'comprador_id' => $comprador->user->id,
            ]
        );

        if ($comprador->user->id == $firmas_requi->responsable_finanzas_id || $comprador->user->id == $firmas_requi->jefe_id || $comprador->user->id == $firmas_requi->solicitante_id) {
            Mail::to(trim($this->removeUnicodeCharacters($userEmail)))->queue(new RequisicionesFirmaDuplicadaEmail($requisicion, $organizacion, $request->tipo_firma));
        } else {
            Mail::to(trim($this->removeUnicodeCharacters($userEmail)))->queue(new RequisicionesEmail($requisicion, $organizacion, $request->tipo_firma));
        }
    }

    if ($request->tipo_firma == 'firma_compras') {
        $fecha = date('d-m-Y');
        $requisicion->fecha_firma_comprador_requi = $fecha;
        $requisicion->save();

        // correo de compras
        $userEmail = $requisicion->email;
        $requisicion->update([
            'estado' => 'firmada',
        ]);
        $organizacion = Organizacion::getFirst();
        Mail::to(removeUnicodeCharacters($userEmail))->queue(new RequisicionesEmail($requisicion, $organizacion, $request->tipo_firma));
    }

    return response('Correcto', 200)->header('Content-Type', 'application/json');
} catch (\Throwable $th) {
    return response('Error', 500)->header('Content-Type', 'application/json');
}
    }

    public function removeUnicodeCharacters($string)
    {
        return trim(preg_replace('/[^\x00-\x7F]/u', '', $string));
    }

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
}
