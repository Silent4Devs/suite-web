<?php

namespace App\Http\Controllers\Api\V1\Requisiciones;

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

class tbRequisicionesApiMobileController extends Controller
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
            if ($firma_siguiente && isset($firma_siguiente->solicitante_id)) {
                if ($user->empleado->id == $firma_siguiente->solicitante_id) { //solicitante_id
                    $tipo_firma = 'firma_solicitante';
                    $alerta = $this->validacionLista($tipo_firma);
                } else {
                    $mensaje = 'No tiene permisos para firmar<br> En espera del solicitante directo: <br> <strong>' . $firma_siguiente->solicitante->name . '</strong>';

                    return view('contract_manager.requisiciones.error', compact('mensaje'));
                }
            } else {

                $$responsable = User::find($requisicion->id_user)->empleado;

                if ($user->empleado->id == $responsable->id) {
                    $tipo_firma = 'firma_solicitante';
                } else {
                    $mensaje = 'No tiene permisos para firmar<br> En espera del solicitante directo';

                    return view('contract_manager.requisiciones.error', compact('mensaje'));
                }
            }
        } elseif ($requisicion->firma_jefe === null) {
            if ($firma_siguiente && isset($firma_siguiente->jefe_id)) {
                if ($user->empleado->id == $firma_siguiente->jefe_id) { //jefe_id
                    $tipo_firma = 'firma_jefe';
                    $alerta = $this->validacionLista($tipo_firma);
                } else {
                    $mensaje = 'No tiene permisos para firmar<br> En espera del jefe directo: <br> <strong>' . $firma_siguiente->jefe->name . '</strong>';

                    return view('contract_manager.requisiciones.error', compact('mensaje'));
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
                    $mensaje = 'No tiene permisos para firmar<br> En espera del jefe directo';

                    return view('contract_manager.requisiciones.error', compact('mensaje'));
                }
            }
        } elseif ($requisicion->firma_finanzas === null) {
            if ($firma_siguiente && isset($firma_siguiente->responsable_finanzas_id)) {
                if ($user->empleado->id == $firma_siguiente->responsable_finanzas_id) { //responsable_finanzas_id
                    $tipo_firma = 'firma_finanzas';
                } else {
                    $mensaje = 'No tiene permisos para firmar<br> En espera de finanzas:' . $firma_siguiente->responsableFinanzas->name;

                    return view('contract_manager.requisiciones.error', compact('mensaje'));
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
                    $mensaje = 'No tiene permisos para firmar<br> En espera del responsable de finanzas';

                    return view('contract_manager.requisiciones.error', compact('mensaje'));
                }
            }
        } elseif ($requisicion->firma_compras === null) {
            if ($firma_siguiente && isset($firma_siguiente->comprador_id)) {
                if (($user->empleado->id == $comprador->user->id) && ($user->empleado->id == $firma_siguiente->comprador_id)) { //comprador_id
                    $tipo_firma = 'firma_compras';
                } else {
                    $mensaje = 'No tiene permisos para firmar<br> En espera del comprador: <br> <strong>' . $comprador->user->name . '</strong>';

                    return view('contract_manager.requisiciones.error', compact('mensaje'));
                }
            } else {
                if (($user->empleado->id == $comprador->user->id)) { //comprador_id
                    $tipo_firma = 'firma_compras';
                } else {
                    $mensaje = 'No tiene permisos para firmar<br> En espera del comprador: <br> <strong>' . $comprador->user->name . '</strong>';

                    return view('contract_manager.requisiciones.error', compact('mensaje'));
                }
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
}

