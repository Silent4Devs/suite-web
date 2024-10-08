<?php

namespace App\Http\Controllers\Api\V1\OrdenesCompra;

use App\Http\Controllers\Controller;
use App\Mail\OrdenCompraAprobada;
use App\Mail\RequisicionesEmail;
use App\Models\ContractManager\Comprador as KatbolComprador;
use App\Models\ContractManager\ProvedorRequisicionCatalogo as KatbolProvedorRequisicionCatalogo;
use App\Models\ContractManager\ProveedorIndistinto as KatbolProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC as KatbolProveedorOC;
use App\Models\ContractManager\Requsicion as KatbolRequsicion;
use App\Models\Empleado;
use App\Models\FirmasRequisiciones;
use App\Models\ListaDistribucion;
use App\Models\ListaInformativa;
use App\Models\Organizacion;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isEmpty;

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

        // if ($user->roles->contains('title', 'Admin') || $user->can('visualizar_todas_requisicion')) {

            // $ordenes_compra = KatbolRequsicion::ordenesCompraAprobadorMobile($user->empleado->id,'general');

            // if($ordenes_compra->isEmpty()){
            //     return response(json_encode([
            //     'ordenCompra' => [],
            // ]), 200)->header('Content-Type', 'application/json');
            // }

            // foreach ($ordenes_compra as $keyOrd => $orden_compra) {
            //     if ($orden_compra->id_user != null) {

            //         if ($orden_compra->proveedor_catalogo_oc === null || isEmpty($orden_compra->proveedor_catalogo_oc) ) {
            //             // Verifica si 'proveedores_requisiciones' está definido y tiene al menos un contacto
            //             if ($orden_compra->proveedores_requisiciones && ! empty($orden_compra->proveedores_requisiciones)) {
            //                 $proveedor = $orden_compra->proveedores_requisiciones[0]->contacto;
            //             } else {
            //                 $proveedor = 'Pendiente';
            //             }
            //         } else {
            //             $proveedor = $orden_compra->proveedor_catalogo_oc; // Valor no es null ni undefined
            //         }

            //         $estado = null;

            //         if ($orden_compra->estatus == 'rechazado_oc') {
            //             $estado = 'Rechazado';
            //         } else {
            //             if (! $orden_compra->firma_solicitante && ! $orden_compra->firma_comprador && ! $orden_compra->firma_finanzas) {
            //                 $estado = 'Por iniciar';
            //             } elseif ($orden_compra->firma_solicitante && $orden_compra->firma_comprador && $orden_compra->firma_finanzas) {
            //                 $estado = 'Firmada';
            //             } else {
            //                 $estado = 'En curso';
            //             }
            //         }

            //         $user = User::find($orden_compra->id_user);

            //         // Validar si el usuario tiene relación empleado
            //         if ($user && $user->empleado) {
            //             $empleado = $user->empleado;
            //         } else {
            //             $empleado = null; // O asignar valores predeterminados aquí
            //         }

            //         $json_orden[$keyOrd] = [
            //             'id'=> $orden_compra->id,
            //             'folio' => $orden_compra->folio,
            //             'fecha' => $orden_compra->fecha,
            //             'referencia' => $orden_compra->referencia,
            //             'estatus' => $estado,
            //             'proveedor_catalogo_oc' => $proveedor,
            //             'no_contrato' => $orden_compra->contrato->no_contrato ?? 'Campo Vacío',
            //             'nombre_servicio' => $orden_compra->contrato->nombre_servicio ?? 'Campo Vacío',
            //             'area' => $orden_compra->area,
            //             'user' => $orden_compra->user,
            //             // "sub_total" => $orden_compra->sub_total,
            //             // "iva" => $orden_compra->iva,
            //             // "total" => $orden_compra->total,
            //         ];
            //     }
            // }

            // return response(json_encode([
            //     'ordenCompra' => $json_orden,
            // ]), 200)->header('Content-Type', 'application/json');
        // } else {
            $ordenes_compra = KatbolRequsicion::ordenesCompraAprobadorMobile($user->empleado->id,'general');

            if($ordenes_compra->isEmpty()){
                return response(json_encode([
                'ordenCompra' => [],
            ]), 200)->header('Content-Type', 'application/json');
            }

            foreach ($ordenes_compra as $keyOrd => $orden_compra) {
                if ($orden_compra->id_user != null) {

                    if ($orden_compra->proveedor_catalogo_oc === null || isEmpty($orden_compra->proveedor_catalogo_oc) ) {
                        // Verifica si 'proveedores_requisiciones' está definido y tiene al menos un contacto
                        if ($orden_compra->proveedores_requisiciones && ! empty($orden_compra->proveedores_requisiciones)) {
                            $proveedor = $orden_compra->proveedores_requisiciones[0]->contacto;
                        } else {
                            $proveedor = 'Pendiente';
                        }
                    } else {
                        $proveedor = $orden_compra->proveedor_catalogo_oc; // Valor no es null ni undefined
                    }

                    $estado = null;

                    if ($orden_compra->estatus == 'rechazado_oc') {
                        $estado = 'Rechazado';
                    } else {
                        if (! $orden_compra->firma_solicitante && ! $orden_compra->firma_comprador && ! $orden_compra->firma_finanzas) {
                            $estado = 'Por iniciar';
                        } elseif ($orden_compra->firma_solicitante && $orden_compra->firma_comprador && $orden_compra->firma_finanzas) {
                            $estado = 'Firmada';
                        } else {
                            $estado = 'En curso';
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
                        'id'=> $orden_compra->id,
                        'folio' => $orden_compra->folio,
                        'fecha' => $orden_compra->fecha,
                        'referencia' => $orden_compra->referencia,
                        'estatus' => $estado,
                        'proveedor_catalogo_oc' => $proveedor,
                        'no_contrato' => $orden_compra->contrato->no_contrato ?? 'Campo Vacío',
                        'nombre_servicio' => $orden_compra->contrato->nombre_servicio ?? 'Campo Vacío',
                        'area' => $orden_compra->area,
                        'user' => $orden_compra->user,
                        // "sub_total" => $orden_compra->sub_total,
                        // "iva" => $orden_compra->iva,
                        // "total" => $orden_compra->total,
                    ];
                }
            }

            return response(json_encode([
                'ordenCompra' => $json_orden,
            ]), 200)->header('Content-Type', 'application/json');
        // }
        // else {
        //     $ordenes_compra_solicitante = KatbolRequsicion::getOCAll()->where('id_user', $user->id);

        //     foreach ($ordenes_compra_solicitante as $keyOrd => $orden_compra) {
        //         if ($orden_compra->id_user != null) {

        //             if ($orden_compra->proveedor_catalogo_oc === null || typeOf($orden_compra->proveedor_catalogo_oc) === 'undefined') {
        //                 // Verifica si 'proveedores_requisiciones' está definido y tiene al menos un contacto
        //                 if ($orden_compra->proveedores_requisiciones && ! empty($orden_compra->proveedores_requisiciones)) {
        //                     $proveedor = $orden_compra->proveedores_requisiciones[0]->contacto;
        //                 } else {
        //                     $proveedor = 'Pendiente';
        //                 }
        //             } else {
        //                 $proveedor = $orden_compra->proveedor_catalogo_oc; // Valor no es null ni undefined
        //             }

        //             $estado = null;

        //             if ($orden_compra->estatus == 'rechazado_oc') {
        //                 $estado = 'Rechazado';
        //             } else {
        //                 if (! $orden_compra->firma_solicitante && ! $orden_compra->firma_comprador && ! $orden_compra->firma_finanzas) {
        //                     $estado = 'Por iniciar';
        //                 } elseif ($orden_compra->firma_solicitante && $orden_compra->firma_comprador && $orden_compra->firma_finanzas) {
        //                     $estado = 'Firmada';
        //                 } else {
        //                     $estado = 'En curso';
        //                 }
        //             }

        //             $json_orden[$keyOrd] = [
        //                 'id' => $orden_compra->id,
        //                 'folio' => $orden_compra->folio,
        //                 'fecha' => $orden_compra->fecha,
        //                 'referencia' => $orden_compra->referencia,
        //                 'estatus' => $estado,
        //                 'proveedor_catalogo_oc' => $proveedor,
        //                 'no_contrato' => $orden_compra->contrato->no_contrato ?? 'Campo Vacío',
        //                 'nombre_servicio' => $orden_compra->contrato->nombre_servicio ?? 'Campo Vacío',
        //                 'area' => $orden_compra->area,
        //                 'user' => $orden_compra->user,
        //                 // "sub_total" => $orden_compra->sub_total,
        //                 // "iva" => $orden_compra->iva,
        //                 // "total" => $orden_compra->total,
        //             ];
        //         }
        //     }

        //     return response(json_encode([
        //         'ordenCompra' => $json_orden,
        //     ]), 200)->header('Content-Type', 'application/json');
        // }
    }

    public function firmarAprobadores($id)
    {
        $bandera = true;
        $requisicion = KatbolRequsicion::getOCAll()->where('id', $id)->first();

        $user = User::getCurrentUser();
        // $supervisor = User::find($requisicion->id_user)->empleado->supervisor->name;
        // $supervisor_email = User::find($requisicion->id_user)->empleado->supervisor->email;
        $comprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();
        $solicitante = User::find($requisicion->id_user);

        $firma_siguiente = FirmasRequisiciones::where('requisicion_id', $requisicion->id)->first();

        if ($solicitante && isset($solicitante->email)) {
            if ($requisicion->firma_comprador_orden === null && $requisicion->estado != 'rechazado') {
                if (removeUnicodeCharacters($comprador->user->email) === removeUnicodeCharacters($user->email)) {
                    $tipo_firma = 'firma_comprador_orden';
                } else {
                    $mensaje = 'No tiene permisos para firmar. En espera del comprador directo: '.$comprador->user->name;

                    return response(json_encode([
                        'orden' => $mensaje,
                    ]), 200)->header('Content-Type', 'application/json');
                }
            } elseif ($requisicion->firma_solicitante_orden === null && $requisicion->estado != 'rechazado') {
                if (removeUnicodeCharacters($user->email) === removeUnicodeCharacters($solicitante->email)) {
                    $tipo_firma = 'firma_solicitante_orden';
                } else {
                    $mensaje = 'No tiene permisos para firmar. En espera del solicitante directo: '.$solicitante->name;

                    return response(json_encode([
                        'orden' => $mensaje,
                    ]), 200)->header('Content-Type', 'application/json');
                }
            } elseif ($requisicion->firma_finanzas_orden === null && $requisicion->estado != 'rechazado') {
                if ($firma_siguiente && isset($firma_siguiente->responsable_finanzas_id)) {
                    if ($user->empleado->id == $firma_siguiente->responsable_finanzas_id) { //responsable_finanzas_id
                        $tipo_firma = 'firma_finanzas_orden';
                    } else {
                        $mensaje = 'No tiene permisos para firmar En espera de finanzas:'.$firma_siguiente->responsableFinanzas->name;

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
                        $tipo_firma = 'firma_finanzas_orden';
                    } else {
                        $mensaje = 'No tiene permisos para firmar En espera del responsable de finanzas';

                        return response(json_encode([
                            'requisicion' => $mensaje,
                        ]), 200)->header('Content-Type', 'application/json');
                    }
                }
            } elseif ($requisicion->estado != 'rechazado') {
                $tipo_firma = 'firma_final_aprobadores';
                $bandera = $this->bandera = false;
            } else {
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

            // $json_requisicion['alerta'] = [
            //     'alerta' => $alerta,
            // ];

            $json_requisicion['general'] = [
                'id' => $requisicion->id,
                'fecha' => date('d-m-Y', strtotime($requisicion->fecha)),
                'referencia' => $requisicion->referencia,
                'area' => $requisicion->area,
                'nombre_comprador' => $comprador->user->name,
                'nombre_solicitante' => $requisicion->user,
            ];

            if ($requisicion->contrato === null) {
                $json_requisicion['contrato'] = 'Contrato Eliminado';
            } else {
                $json_requisicion['contrato'] = [
                    'no_proyecto' => $requisicion->contrato->no_proyecto ?? '',
                    'no_contrato' => $requisicion->contrato->no_contrato ?? '',
                    'nombre_servicio' => $requisicion->contrato->nombre_servicio ?? '',
                ];
            }

            $json_requisicion['info_sucursal'] = [
                'empresa' => $requisicion->sucursal->empresa,
                'rfc' => $requisicion->sucursal->rfc,
                'razon_social' => $requisicion->sucursal->descripcion,
                'direccion' => $requisicion->sucursal->direccion,
                'url_foto_empresa' => 'razon_social/'.$imagen_logo,
            ];

            $json_requisicion['info_pago'] = [
                'moneda' => $requisicion->moneda,
                'tipo_pago' => $requisicion->pago,
                'dias_credito' => $requisicion->dias_credito,
                'tipo_cambio' => $requisicion->cambio,
            ];

            foreach ($requisicion->productos_requisiciones as $producto) {
                $json_requisicion['productos'][] = [
                    'cantidad_producto' => $producto->cantidad ?? '',
                    'descripcion_producto' => $producto->producto->descripcion ?? '',
                    'espesificaciones_producto' => $producto->espesificaciones ?? '',
                    'subtotal_producto' => $producto->subtotal ?? 'Sin registrar',
                    'descuento_producto' => $producto->descuento ?? 'Sin registrar',
                    'otro_impuesto_producto' => $producto->otro_impuesto ?? 'Sin registrar',
                    'iva_producto' => $producto->iva ?? 'Sin registrar',
                    'iva_retenido_producto' => $producto->iva_retenido ?? 'Sin registrar',
                    'isr_retenido_producto' => $producto->isr_retenido ?? 'Sin registrar',
                    'total_producto' => $producto->total ?? 'Sin registrar',
                    'descripcion_centro_costo' => $producto->centro_costo->descripcion ?? 'Sin registrar',
                    'no_personas' => $producto->no_personas ?? 'Sin registrar',
                    'porcentaje_involucramiento_producto' => $producto->porcentaje_involucramiento ?? 'Sin registrar',
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
                    $json_requisicion['proveedor'][] = [
                        'nombre_proveedor' => $prov->nombre ?? '',
                        'empresa_proveedor' => $prov->razon_social ?? '',
                        'rfc_proveedor' => $prov->rfc,
                        'contacto_proveedor' => $prov->contacto,
                        'fechaInicio_proveedor' => date('d-m-Y', strtotime($prov->fecha_inicio)) ?? 'La fecha de inicio no está disponible.',
                        'fechaFin_proveedor' => date('d-m-Y', strtotime($prov->fecha_fin)) ?? 'La fecha fin no está disponible.',
                    ];
                }
            }

            if (! empty($proveedores_indistintos)) {
                foreach ($proveedores_indistintos as $prov) {
                    $json_requisicion['proveedor_indistinto'][] = [
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

    public function removeUnicodeCharacters($string)
    {
        return trim(preg_replace('/[^\x00-\x7F]/u', '', $string));
    }

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

        $organizacion = Organizacion::getFirst();
        $tipo_firma = 'rechazado';
        Mail::to($requisicion->email)->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));

        return redirect('contract_manager/orden-compra');
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

        $copiasNivel = [];
        $responsablesAusentes = [];
        $correosCopia = [];

        $organizacion = Organizacion::getFirst();
        $userEmail = $requisicion->email;

        if ($tipo_firma == 'firma_solicitante_orden') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_solicitante_orden = $fecha;
            $requisicion->save();

            $listaReq = ListaDistribucion::where('modelo', $this->modelo)->first();
            $listaPart = $listaReq->participantes;
            // dump($listaPart);
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

            // $user = 'lourdes.abadia@silent4business.com';
            Mail::to($userEmail)->cc($correosCopia)->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
            // Mail::to('ldelgadillo@silent4business.com')->cc('aurora.soriano@silent4business.com')->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
        }
        if ($tipo_firma == 'firma_comprador_orden') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_comprador_orden = $fecha;
            $requisicion->save();

            // correo de finanzas
            $userEmail = $requisicion->email;
            $organizacion = Organizacion::getFirst();
            Mail::to($userEmail)->cc($correosCopia)->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
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

            if (isset($requisicion->contrato->proyectoConvergencia->tipo)) {
                if ($requisicion->contrato->proyectoConvergencia->tipo == 'Interno') {
                    $tipo_orden = '	Ordenes de Compra - Internas';
                    $orden_correo = 'Interno';
                } elseif ($requisicion->contrato->proyectoConvergencia->tipo == 'Externo') {
                    $tipo_orden = 'Ordenes de Compra - Externas';
                    $orden_correo = 'Externo';
                } else {
                    $tipo_orden = 'Ordenes de Compra - Externas';
                    $orden_correo = 'Externo';
                }
            } else {
                $tipo_orden = 'Ordenes de Compra - Externas';
                $orden_correo = 'Externo';
            }

            $listaInformativa = ListaInformativa::where('modelo', $this->modelo)->where('submodulo', $tipo_orden)->first();
            foreach ($listaInformativa->participantes as $key => $informado) {
                $correos_informados[] = $informado->empleado->email;
            }

            foreach ($listaInformativa->usuarios as $key => $informado) {
                $correos_informados[] = $informado->usuario->email;
            }

            $organizacionInformado = Organizacion::getFirst();
            Mail::to($correos_informados)->queue(new OrdenCompraAprobada($requisicion, $organizacionInformado, $orden_correo));
        }

        Mail::to($userEmail)->cc($correosCopia)->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));

        return redirect(route('contract_manager.orden-compra'));
    }
}
