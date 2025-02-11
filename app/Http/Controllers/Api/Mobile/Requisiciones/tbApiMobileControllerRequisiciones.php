<?php

namespace App\Http\Controllers\Api\Mobile\Requisiciones;

use App\Http\Controllers\Controller;
use App\Mail\RequisicionesEmail;
use App\Mail\RequisicionesFirmaDuplicadaEmail;
use App\Models\ContractManager\Comprador as KatbolComprador;
use App\Models\ContractManager\ProvedorRequisicionCatalogo as KatbolProvedorRequisicionCatalogo;
use App\Models\ContractManager\ProveedorIndistinto as KatbolProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC as KatbolProveedorOC;
use App\Models\ContractManager\Requsicion as KatbolRequsicion;
use App\Models\Empleado;
use App\Models\FirmasRequisiciones;
use App\Models\ListaDistribucion;
use App\Models\Organizacion;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class tbApiMobileControllerRequisiciones extends Controller
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
            $requisiciones = KatbolRequsicion::getArchivoFalseAll();

            foreach ($requisiciones as $keyReq => $requisicion) {
                if ($requisicion->id_user != null) {
                    $estado = null;
                    switch ($requisicion->estado) {
                        case 'curso':
                            $estado = 'En curso';
                            break;

                        case 'aprobado':
                            $estado = 'Aprobado';
                            break;

                        case 'rechazado':
                            $estado = 'Rechazado';
                            break;

                        case 'firmada':
                            $estado = 'Firmada';
                            break;

                        case 'firmada_final':
                            $estado = 'Firmada';
                            break;

                        default:
                            $estado = 'Por iniciar';
                            break;
                    }

                    $user = User::find($requisicion->id_user);

                    // Validar si el usuario tiene relación empleado
                    if ($user && $user->empleado) {
                        $empleado = $user->empleado;
                    } else {
                        $empleado = null; // O asignar valores predeterminados aquí
                    }

                    // Foto del solicitante
                    if ($empleado && ($empleado->foto == null || $empleado->foto == '0')) {
                        if ($empleado->genero == 'H') {
                            $ruta = asset('storage/empleados/imagenes/man.png');
                        } elseif ($empleado->genero == 'M') {
                            $ruta = asset('storage/empleados/imagenes/woman.png');
                        } else {
                            $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                        }
                    } elseif ($empleado) {
                        $ruta = asset('storage/empleados/imagenes/'.$empleado->foto);
                    } else {
                        $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png'); // Valor predeterminado si no hay empleado
                    }

                    $ruta_foto_user = $this->encodeSpecialCharacters($ruta);

                    $participantes['solicitante'] = [
                        'nombre_participante' => $empleado->name ?? '', // Si no hay empleado, asignar ''
                        'foto_participante' => $ruta_foto_user,
                        'estatus_firma' => is_null($requisicion->firma_solicitante),
                    ];

                    // Foto y nombre del supervisor
                    if ($empleado && $empleado->supervisor) {
                        $supervisorName = $empleado->supervisor->name ?? 'N/A';
                        $supervisorFoto = $empleado->supervisor->foto ?? 'usuario_no_cargado.png';
                        if ($supervisorFoto == null || $supervisorFoto == '0') {
                            if ($empleado->supervisor->genero == 'H') {
                                $ruta_supervisor = asset('storage/empleados/imagenes/man.png');
                            } elseif ($empleado->supervisor->genero == 'M') {
                                $ruta_supervisor = asset('storage/empleados/imagenes/woman.png');
                            } else {
                                $ruta_supervisor = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                            }
                        } else {
                            $ruta_supervisor = asset('storage/empleados/imagenes/'.$supervisorFoto);
                        }
                    } else {
                        $supervisorName = 'N/A';
                        $ruta_supervisor = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                    }

                    $ruta_foto_supervisor = $this->encodeSpecialCharacters($ruta_supervisor);

                    $participantes['supervisor'] = [
                        'nombre_participante' => $supervisorName,
                        'foto_participante' => $ruta_foto_supervisor,
                        'estatus_firma' => is_null($requisicion->firma_jefe),
                    ];

                    $participantes['finanzas'] = [
                        'nombre_participante' => 'Finanzas',
                        'foto_participante' => asset('storage/empleados/imagenes/usuario_no_cargado.png'),
                        'estatus_firma' => is_null($requisicion->firma_finanzas),
                    ];

                    $comprador = KatbolComprador::with('user')
                        ->where('id', $requisicion->comprador_id)
                        ->first();

                    $comp = $comprador->user;

                    if ($comp->foto == null || $comp->foto == '0') {
                        if ($comp->genero == 'H') {
                            $ruta_comprador = asset('storage/empleados/imagenes/man.png');
                        } elseif ($comp->genero == 'M') {
                            $ruta_comprador = asset('storage/empleados/imagenes/woman.png');
                        } else {
                            $ruta_comprador = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                        }
                    } else {
                        $ruta_comprador = asset('storage/empleados/imagenes/'.$comp->foto);
                    }

                    // Encode spaces in the URL
                    $ruta_foto_comprador = $this->encodeSpecialCharacters($ruta_comprador);

                    $participantes['comprador'] = [
                        'nombre_participante' => $comprador->name ?? '',
                        'foto_participante' => $ruta_foto_comprador,
                        'estatus_firma' => is_null($requisicion->firma_compras),
                    ];

                    $json_requisicion[$keyReq] = [
                        'id' => $requisicion->id,
                        'folio' => 'RQ-00-00-'.$requisicion->id,
                        'fecha_solicitud' => $requisicion->fecha,
                        'referencia' => $requisicion->referencia,
                        'proveedor' => $requisicion->proveedor_catalogo ?? ($requisicion->provedores_requisiciones->first()->contacto ?? 'Indistinto'),
                        'estatus' => $estado,
                        'participantes' => $participantes,
                        'proyecto' => $requisicion->contrato->nombre_servicio ?? 'Sin servicio disponible',
                        'area_solicita' => $requisicion->area,
                        'solicitante' => $requisicion->user,
                    ];
                }

                return response(
                    json_encode([
                        'requisicion' => $json_requisicion,
                    ]),
                    200,
                )->header('Content-Type', 'application/json');
            }
        } else {
            $requisiciones = KatbolRequsicion::requisicionesAprobadorMobile($user->empleado->id, 'general');

            if ($requisiciones->isEmpty()) {
                return response(
                    json_encode([
                        'requisicion' => [],
                    ]),
                    200,
                )->header('Content-Type', 'application/json');
            }

            // dd($requisiciones);

            // if ($user->roles->contains('title', 'Admin') || $user->can('visualizar_todas_requisicion')) {
            // $requisiciones = KatbolRequsicion::getArchivoFalseAll();
            foreach ($requisiciones as $keyReq => $requisicion) {
                if ($requisicion->id_user != null) {
                    $estado = null;
                    switch ($requisicion->estado) {
                        case 'curso':
                            $estado = 'En curso';
                            break;

                        case 'aprobado':
                            $estado = 'Aprobado';
                            break;

                        case 'rechazado':
                            $estado = 'Rechazado';
                            break;

                        case 'firmada':
                            $estado = 'Firmada';
                            break;

                        case 'firmada_final':
                            $estado = 'Firmada';
                            break;

                        default:
                            $estado = 'Por iniciar';
                            break;
                    }

                    $user = User::find($requisicion->id_user);

                    // Validar si el usuario tiene relación empleado
                    if ($user && $user->empleado) {
                        $empleado = $user->empleado;
                    } else {
                        $empleado = null; // O asignar valores predeterminados aquí
                    }

                    // Foto del solicitante
                    if ($empleado && ($empleado->foto == null || $empleado->foto == '0')) {
                        if ($empleado->genero == 'H') {
                            $ruta = asset('storage/empleados/imagenes/man.png');
                        } elseif ($empleado->genero == 'M') {
                            $ruta = asset('storage/empleados/imagenes/woman.png');
                        } else {
                            $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                        }
                    } elseif ($empleado) {
                        $ruta = asset('storage/empleados/imagenes/'.$empleado->foto);
                    } else {
                        $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png'); // Valor predeterminado si no hay empleado
                    }

                    $ruta_foto_user = $this->encodeSpecialCharacters($ruta);

                    $participantes['solicitante'] = [
                        'nombre_participante' => $empleado->name ?? '', // Si no hay empleado, asignar ''
                        'foto_participante' => $ruta_foto_user,
                        'estatus_firma' => is_null($requisicion->firma_solicitante),
                    ];

                    // Foto y nombre del supervisor
                    if ($empleado && $empleado->supervisor) {
                        $supervisorName = $empleado->supervisor->name ?? 'N/A';
                        $supervisorFoto = $empleado->supervisor->foto ?? 'usuario_no_cargado.png';
                        if ($supervisorFoto == null || $supervisorFoto == '0') {
                            if ($empleado->supervisor->genero == 'H') {
                                $ruta_supervisor = asset('storage/empleados/imagenes/man.png');
                            } elseif ($empleado->supervisor->genero == 'M') {
                                $ruta_supervisor = asset('storage/empleados/imagenes/woman.png');
                            } else {
                                $ruta_supervisor = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                            }
                        } else {
                            $ruta_supervisor = asset('storage/empleados/imagenes/'.$supervisorFoto);
                        }
                    } else {
                        $supervisorName = 'N/A';
                        $ruta_supervisor = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                    }

                    $ruta_foto_supervisor = $this->encodeSpecialCharacters($ruta_supervisor);

                    $participantes['supervisor'] = [
                        'nombre_participante' => $supervisorName,
                        'foto_participante' => $ruta_foto_supervisor,
                        'estatus_firma' => is_null($requisicion->firma_jefe),
                    ];

                    $participantes['finanzas'] = [
                        'nombre_participante' => 'Finanzas',
                        'foto_participante' => asset('storage/empleados/imagenes/usuario_no_cargado.png'),
                        'estatus_firma' => is_null($requisicion->firma_finanzas),
                    ];

                    $comprador = KatbolComprador::with('user')
                        ->where('id', $requisicion->comprador_id)
                        ->first();

                    $comp = $comprador->user;

                    if ($comp->foto == null || $comp->foto == '0') {
                        if ($comp->genero == 'H') {
                            $ruta_comprador = asset('storage/empleados/imagenes/man.png');
                        } elseif ($comp->genero == 'M') {
                            $ruta_comprador = asset('storage/empleados/imagenes/woman.png');
                        } else {
                            $ruta_comprador = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                        }
                    } else {
                        $ruta_comprador = asset('storage/empleados/imagenes/'.$comp->foto);
                    }

                    // Encode spaces in the URL
                    $ruta_foto_comprador = $this->encodeSpecialCharacters($ruta_comprador);

                    $participantes['comprador'] = [
                        'nombre_participante' => $comprador->name ?? '',
                        'foto_participante' => $ruta_foto_comprador,
                        'estatus_firma' => is_null($requisicion->firma_compras),
                    ];

                    $json_requisicion[$keyReq] = [
                        'id' => $requisicion->id,
                        'folio' => 'RQ-00-00-'.$requisicion->id,
                        'fecha_solicitud' => $requisicion->fecha,
                        'referencia' => $requisicion->referencia,
                        'proveedor' => $requisicion->proveedor_catalogo ?? ($requisicion->provedores_requisiciones->first()->contacto ?? 'Indistinto'),
                        'estatus' => $estado,
                        'participantes' => $participantes,
                        'proyecto' => $requisicion->contrato->nombre_servicio ?? 'Sin servicio disponible',
                        'area_solicita' => $requisicion->area,
                        'solicitante' => $requisicion->user,
                    ];
                }
            }
            // $new = [];
            // foreach($json_requisicion as $item){
            //     $new[] = $item;
            // }

            return response(
                json_encode([
                    'requisicion' => $json_requisicion,
                ]),
                200,
            )->header('Content-Type', 'application/json');
        }

        //     // return view('contract_manager.requisiciones.index', compact('requisiciones', 'empresa_actual', 'logo_actual'));
        // } else {
        //     $requisiciones_solicitante = KatbolRequsicion::getArchivoFalseAll()->where('id_user', $user->id);

        //     dd($requisiciones_solicitante);
        //     if(!empty($requisiciones_solicitante)){
        //         foreach ($requisiciones_solicitante as $keyReq => $requisicion) {
        //                 if($requisicion->id_user != null){
        //                     $estado = null;
        //                     switch($requisicion->estado)
        //                     {
        //                         case 'curso':
        //                             $estado = "En curso";
        //                         break;

        //                         case 'aprobado':
        //                             $estado = "Aprobado";
        //                         break;

        //                         case 'rechazado':
        //                             $estado = "Rechazado";
        //                         break;

        //                         case 'firmada':
        //                             $estado = "Firmada";
        //                         break;

        //                         case 'firmada_final':
        //                             $estado = "Firmada";
        //                         break;

        //                         default:
        //                             $estado = "Por iniciar";
        //                         break;
        //                     };

        //                     $user = User::find($requisicion->id_user);

        //                     // Validar si el usuario tiene relación empleado
        //                     if ($user && $user->empleado) {
        //                         $empleado = $user->empleado;
        //                     } else {
        //                         $empleado = null; // O asignar valores predeterminados aquí
        //                     }

        //                     // Foto del solicitante
        //                     if ($empleado && ($empleado->foto == null || $empleado->foto == '0')) {
        //                         if ($empleado->genero == 'H') {
        //                             $ruta = asset('storage/empleados/imagenes/man.png');
        //                         } elseif ($empleado->genero == 'M') {
        //                             $ruta = asset('storage/empleados/imagenes/woman.png');
        //                         } else {
        //                             $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
        //                         }
        //                     } elseif ($empleado) {
        //                         $ruta = asset('storage/empleados/imagenes/'.$empleado->foto);
        //                     } else {
        //                         $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png'); // Valor predeterminado si no hay empleado
        //                     }

        //                     $ruta_foto_user = $this->encodeSpecialCharacters($ruta);

        //                     $participantes["solicitante"] = [
        //                         "nombre_participante" => $empleado->name ?? '', // Si no hay empleado, asignar ''
        //                         "foto_participante" => $ruta_foto_user,
        //                         "estatus_firma" => is_null($requisicion->firma_solicitante),
        //                     ];

        //                     // Foto y nombre del supervisor
        //                     if ($empleado && $empleado->supervisor) {
        //                         $supervisorName = $empleado->supervisor->name ?? 'N/A';
        //                         $supervisorFoto = $empleado->supervisor->foto ?? 'usuario_no_cargado.png';
        //                         if ($supervisorFoto == null || $supervisorFoto == '0') {
        //                             if ($empleado->supervisor->genero == 'H') {
        //                                 $ruta_supervisor = asset('storage/empleados/imagenes/man.png');
        //                             } elseif ($empleado->supervisor->genero == 'M') {
        //                                 $ruta_supervisor = asset('storage/empleados/imagenes/woman.png');
        //                             } else {
        //                                 $ruta_supervisor = asset('storage/empleados/imagenes/usuario_no_cargado.png');
        //                             }
        //                         } else {
        //                             $ruta_supervisor = asset('storage/empleados/imagenes/'.$supervisorFoto);
        //                         }
        //                     } else {
        //                         $supervisorName = 'N/A';
        //                         $ruta_supervisor = asset('storage/empleados/imagenes/usuario_no_cargado.png');
        //                     }

        //                     $ruta_foto_supervisor = $this->encodeSpecialCharacters($ruta_supervisor);

        //                     $participantes["supervisor"] = [
        //                         "nombre_participante" => $supervisorName,
        //                         "foto_participante" => $ruta_foto_supervisor,
        //                         "estatus_firma" => is_null($requisicion->firma_jefe),
        //                     ];

        //                     $participantes["finanzas"] = [
        //                         "nombre_participante" => "Finanzas",
        //                         "foto_participante" => asset('storage/empleados/imagenes/usuario_no_cargado.png'),
        //                         "estatus_firma" => is_null($requisicion->firma_finanzas),
        //                     ];

        //                     $comprador = KatbolComprador::with('user')
        //                     ->where('id', $requisicion->comprador_id)
        //                     ->first();

        //                     $comp = $comprador->user->empleado;

        //                     if ($comp->foto == null || $comp->foto == '0') {
        //                         if ($comp->genero == 'H') {
        //                             $ruta_comprador = asset('storage/empleados/imagenes/man.png');
        //                         } elseif ($comp->genero == 'M') {
        //                             $ruta_comprador = asset('storage/empleados/imagenes/woman.png');
        //                         } else {
        //                             $ruta_comprador = asset('storage/empleados/imagenes/usuario_no_cargado.png');
        //                         }
        //                     } else {
        //                         $ruta_comprador = asset('storage/empleados/imagenes/'.$comp->foto);
        //                     }

        //                     // Encode spaces in the URL
        //                     $ruta_foto_comprador = $this->encodeSpecialCharacters($ruta_comprador);

        //                     $participantes["comprador"] = [
        //                         "nombre_participante" => $comprador->name ?? '',
        //                         "foto_participante" => $ruta_foto_comprador,
        //                         "estatus_firma" => is_null($requisicion->firma_compras),
        //                     ];

        //                     $json_requisicion[$keyReq] = [
        //                         'id' => $requisicion->id,
        //                         'folio' => "RQ-00-00-".$requisicion->id,
        //                         'fecha_solicitud' => $requisicion->fecha,
        //                         'referencia' => $requisicion->referencia,
        //                         'proveedor' => $requisicion->proveedor_catalogo ?? ($requisicion->provedores_requisiciones->first()->contacto ?? 'Indistinto'),
        //                         'estatus' => $estado,
        //                         'participantes' => $participantes,
        //                         'proyecto' => $requisicion->contrato->nombre_servicio ?? 'Sin servicio disponible',
        //                         'area_solicita' => $requisicion->area,
        //                         'solicitante' => $requisicion->user,
        //                     ];
        //                 }
        //         }

        //             return response(json_encode([
        //                 'requisicion' => $json_requisicion,
        //             ]), 200)->header('Content-Type', 'application/json');
        //     }else {
        //         return response(json_encode([
        //             'requisicion' => [],
        //         ]), 200)->header('Content-Type', 'application/json');
        //     }
        // }
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
        $comprador = KatbolComprador::with('user')
            ->where('id', $requisicion->comprador_id)
            ->first();
        $solicitante = User::find($requisicion->id_user);

        $firma_siguiente = FirmasRequisiciones::where('requisicion_id', $requisicion->id)->first();

        if ($requisicion->firma_solicitante === null && $requisicion->estado != 'rechazado') {
            if ($firma_siguiente && isset($firma_siguiente->solicitante_id)) {
                if ($user->empleado->id == $firma_siguiente->solicitante_id) {
                    // solicitante_id
                    $tipo_firma = 'firma_solicitante';
                    $alerta = $this->validacionLista($tipo_firma);
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera del solicitante directo:'.$firma_siguiente->solicitante->name.'';

                    return response(
                        json_encode([
                            'requisicion' => $mensaje,
                        ]),
                        200,
                    )->header('Content-Type', 'application/json');
                }
            } else {
                $responsable = User::find($requisicion->id_user)->empleado;

                if ($user->empleado->id == $responsable->id) {
                    $tipo_firma = 'firma_solicitante';
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera del solicitante directo';

                    return response(
                        json_encode([
                            'requisicion' => $mensaje,
                        ]),
                        200,
                    )->header('Content-Type', 'application/json');
                }
            }
        } elseif ($requisicion->firma_jefe === null && $requisicion->estado != 'rechazado') {
            if ($firma_siguiente && isset($firma_siguiente->jefe_id)) {
                if ($user->empleado->id == $firma_siguiente->jefe_id) {
                    // jefe_id
                    $tipo_firma = 'firma_jefe';
                    $alerta = $this->validacionLista($tipo_firma);
                } else {
                    $mensaje = 'No tiene permisos para firmar. En espera del jefe directo:'.$firma_siguiente->jefe->name.'';

                    return response(
                        json_encode([
                            'requisicion' => $mensaje,
                        ]),
                        200,
                    )->header('Content-Type', 'application/json');
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

                    return response(
                        json_encode([
                            'requisicion' => $mensaje,
                        ]),
                        200,
                    )->header('Content-Type', 'application/json');
                }
            }
        } elseif ($requisicion->firma_finanzas === null && $requisicion->estado != 'rechazado') {
            if ($firma_siguiente && isset($firma_siguiente->responsable_finanzas_id)) {
                if ($user->empleado->id == $firma_siguiente->responsable_finanzas_id) {
                    // responsable_finanzas_id
                    $tipo_firma = 'firma_finanzas';
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera de finanzas:'.$firma_siguiente->responsableFinanzas->name;

                    return response(
                        json_encode([
                            'requisicion' => $mensaje,
                        ]),
                        200,
                    )->header('Content-Type', 'application/json');
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

                    return response(
                        json_encode([
                            'requisicion' => $mensaje,
                        ]),
                        200,
                    )->header('Content-Type', 'application/json');
                }
            }
        } elseif ($requisicion->firma_compras === null && $requisicion->estado != 'rechazado') {
            if ($firma_siguiente && isset($firma_siguiente->comprador_id)) {
                if ($user->empleado->id == $comprador->user->id && $user->empleado->id == $firma_siguiente->comprador_id) {
                    // comprador_id
                    $tipo_firma = 'firma_compras';
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera del comprador:'.$comprador->user->name.'';

                    return response(
                        json_encode([
                            'requisicion' => $mensaje,
                        ]),
                        200,
                    )->header('Content-Type', 'application/json');
                }
            } else {
                if ($user->empleado->id == $comprador->user->id) {
                    // comprador_id
                    $tipo_firma = 'firma_compras';
                } else {
                    $mensaje = 'No tiene permisos para firmar En espera del comprador:'.$comprador->user->name.'';

                    return response(
                        json_encode([
                            'requisicion' => $mensaje,
                        ]),
                        200,
                    )->header('Content-Type', 'application/json');
                }
            }
        } elseif ($requisicion->estado != 'rechazado') {
            $tipo_firma = 'firma_final_aprobadores';
            $bandera = $this->bandera = false;
        } else {
            $mensaje = 'Esta requisición ya ha sido rechazada';

            return response(
                json_encode([
                    'requisicion' => $mensaje,
                ]),
                200,
            )->header('Content-Type', 'application/json');
        }

        $proveedores_show = KatbolProvedorRequisicionCatalogo::where('requisicion_id', $requisicion->id)
            ->pluck('proveedor_id')
            ->toArray();

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
            'id' => $requisicion->id,
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

        $json_requisicion['info_sucursal'] = [
            'empresa' => $requisicion->sucursal->empresa,
            'rfc' => $requisicion->sucursal->rfc,
            'razon_social' => $requisicion->sucursal->descripcion,
            'direccion' => $requisicion->sucursal->direccion,
            'url_foto_empresa' => 'razon_social/'.$imagen_logo,
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

        return response(
            json_encode([
                'requisicion' => $json_requisicion,
            ]),
            200,
        )->header('Content-Type', 'application/json');
        // return view('contract_manager.requisiciones.firmar', compact('firma_siguiente', 'firma_finanzas_name', 'requisicion', 'organizacion', 'bandera', 'contrato', 'comprador', 'tipo_firma', 'supervisor', 'proveedores_catalogo', 'proveedor_indistinto', 'alerta'));
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
                'tipo_firma' => 'required',
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
                // Buscamos supervisor
                $user = User::find($requisicion->id_user);
                $supervisor = $user->empleado->supervisor;

                // Buscamos modelo correspondiente a lideres
                $listaReq = ListaDistribucion::where('modelo', 'Empleado')->first();
                // Traemos participantes
                $listaPart = $listaReq->participantes;

                // Buscamos al supervisor por su id
                $supList = $listaPart->where('empleado_id', $supervisor->id)->first();

                // Buscamos en que nivel se encuentra el supervisor
                $nivel = $supList->nivel;

                // traemos a todos los participantes correspondientes a ese nivel
                $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

                // Buscamos 1 por 1 los participantes del nivel (area)
                foreach ($participantesNivel as $key => $partNiv) {
                    // Si su estado esta activo se le manda el correo
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
                    ],
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
                            $copiasNivel[] = $this->removeUnicodeCharacters($c->empleado->email);
                        }

                        break;
                    } else {
                        $responsablesAusentes[] = $this->removeUnicodeCharacters($responsableNivel->empleado->email);
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
                    ],
                );

                if ($responsable->id == $firmas_requi->jefe_id || $responsable->id == $firmas_requi->solicitante_id) {
                    Mail::to(trim($this->removeUnicodeCharacters($userEmail)))->queue(new RequisicionesFirmaDuplicadaEmail($requisicion, $organizacion, $request->tipo_firma));
                } else {
                    Mail::to(trim($this->removeUnicodeCharacters($userEmail)))
                        ->cc($correosCopia)
                        ->queue(new RequisicionesEmail($requisicion, $organizacion, $request->tipo_firma));
                }
            }
            if ($request->tipo_firma == 'firma_finanzas') {
                $fecha = date('d-m-Y');
                $requisicion->fecha_firma_finanzas_requi = $fecha;
                $user = User::getCurrentUser();
                $requisicion->id_finanzas = $user->id;
                $requisicion->save();
                $comprador = KatbolComprador::with('user')
                    ->where('id', $requisicion->comprador_id)
                    ->first();
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
                    ],
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
