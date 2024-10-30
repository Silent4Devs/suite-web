<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Mail\OrdenCompraAprobada;
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
use App\Models\HistorialEdicionesOC;
use App\Models\ListaDistribucion;
use App\Models\ListaInformativa;
use App\Models\Organizacion;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use DB;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use NumberFormatter;
use PDF;
use Symfony\Component\HttpFoundation\Response;

class OrdenCompraController extends Controller
{
    use ObtenerOrganizacion;

    public $bandera = true;

    public $modelo = 'OrdenCompra';

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
    }

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

        return view('contract_manager.ordenes-compra.index', compact('buttonSolicitante', 'buttonFinanzas', 'buttonCompras', 'empresa_actual', 'logo_actual'));
    }

    public function getOCIndex(Request $request)
    {
        Log::info("Entra funcion");
        $user = User::getCurrentUser();

        if ($user->roles->contains('title', 'Admin') || $user->can('visualizar_todas_orden_compra')) {
            Log::info("Entra if");
            $requisiciones = KatbolRequsicion::with('contrato', 'provedores_requisiciones')->where([
                ['firma_solicitante', '!=', null],
                ['firma_jefe', '!=', null],
                ['firma_finanzas', '!=', null],
                ['firma_compras', '!=', null],
            ])->where('archivo', false)->orderByDesc('id')
                ->get();
            Log::info('Antes del return if', ['requisiciones' => $requisiciones]);
            return datatables()->of($requisiciones)->toJson();
            Log::info('Despues del return if');
        } else {
            Log::info("Entra else");
            $requisiciones = KatbolRequsicion::with('contrato', 'provedores_requisiciones')->where([
                ['firma_solicitante', '!=', null],
                ['firma_jefe', '!=', null],
                ['firma_finanzas', '!=', null],
                ['firma_compras', '!=', null],
            ])->where('archivo', false)->where('id_user', $user->id)->orderByDesc('id')
                ->get();
            Log::info('Antes del return else', ['requisiciones' => $requisiciones]);
            return datatables()->of($requisiciones)->toJson();
            Log::info('Despues del return else');
        }
        Log::info("No entra en if-else");
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

            $requisicion = KatbolRequsicion::getArchivoFalseAll()->where('id', $id)->first();
            $user = User::find($requisicion->id_finanzas_oc);
            $proveedores = KatbolProveedorOC::getAll()->where('id', $requisicion->proveedor_id)->first();

            if ($user) {
                $firma_finanzas_name = $user->name;
            } else {
                $firma_finanzas_name = null;
            }

            $organizacion = Organizacion::getLogo();

            if (! $requisicion) {
                abort(404);
            }

            // En el controlador para órdenes de compra
            $historialesOrdenCompra = HistorialEdicionesOC::with('version', 'empleado')->where('requisicion_id', $requisicion->id)->get();

            // Agrupando los historiales de órdenes de compra por versión
            $agrupadosPorVersionOrdenesCompra = $historialesOrdenCompra->groupBy(function ($item) {
                return $item->version->version; // Suponiendo que la columna es 'version'
            });

            $resultadoOrdenesCompra = [];
            foreach ($agrupadosPorVersionOrdenesCompra as $version => $cambios) {
                $resultadoOrdenesCompra[] = [
                    'version' => $version,
                    'cambios' => $cambios,
                ];
            }

            return view('contract_manager.ordenes-compra.show', compact('firma_finanzas_name', 'requisicion', 'organizacion', 'proveedores', 'resultadoOrdenesCompra'));
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
            $requisicion = KatbolRequsicion::getArchivoFalseAll()->where('id', $id)->first();
            if (! $requisicion) {
                abort(404);
            }
            $proveedores = KatbolProveedorOC::getAll();
            $proveedor = $proveedores->where('id', $requisicion->proveedor_id)->first();
            $contratos = KatbolContrato::getAll();
            $centro_costos = KatbolCentroCosto::getAll();
            $monedas = KatbolMoneda::getAll();
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
        KatbolRequsicion::desactivarHistorial();
        $requisicion = KatbolRequsicion::find($id);

        $requisicion->update([
            'fecha_entrega' => $request->fecha_entrega,
            'pago' => $request->pago,
            'dias_credito' => $request->dias_credito,
            'moneda' => $request->moneda,
            'cambio' => $request->cambio,
            'proveedoroc_id' => $request->proveedor_id,
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

        $proveedor = KatbolProveedorOC::where('id', $request->proveedor_id)->first();

        $requisicion->update([
            'proveedor_catalogo_oc' => $proveedor->nombre,
        ]);

        $proveedor->update([
            'direccion' => $request->direccion,
            'facturacion' => $request->facturacion,
            'envio' => $request->direccion_envio,
            'credito' => $request->credito_proveedor,
        ]);
        KatbolRequsicion::activarHistorial();

        return redirect(route('contract_manager.orden-compra.firmarAprobadores', ['id' => $requisicion->id]));
    }

    public function editarOrdenCompra($id)
    {
        try {
            abort_if(Gate::denies('katbol_ordenes_compra_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $requisicion = KatbolRequsicion::getArchivoFalseAll()->where('id', $id)->first();
            // dd($requisicion, $requisicion->proveedoroc_id, $requisicion->proveedor);
            if (! $requisicion) {
                abort(404);
            }

            $proveedores = KatbolProveedorOC::getAll();
            $proveedor = $proveedores->where('id', $requisicion->proveedor_id)->first();
            $contratos = KatbolContrato::getAll();
            $centro_costos = KatbolCentroCosto::getAll();
            $monedas = KatbolMoneda::getAll();
            $contrato = $contratos->where('id', $requisicion->contrato_id)->first();
            // dd($requisicion);

            // En el controlador para órdenes de compra
            $historialesOrdenCompra = HistorialEdicionesOC::with('version', 'empleado')->where('requisicion_id', $requisicion->id)->get();

            // Agrupando los historiales de órdenes de compra por versión
            $agrupadosPorVersionOrdenesCompra = $historialesOrdenCompra->groupBy(function ($item) {
                return $item->version->version; // Suponiendo que la columna es 'version'
            });

            $resultadoOrdenesCompra = [];
            foreach ($agrupadosPorVersionOrdenesCompra as $version => $cambios) {
                $resultadoOrdenesCompra[] = [
                    'version' => $version,
                    'cambios' => $cambios,
                ];
            }

            $maximaVersion = collect($resultadoOrdenesCompra)->max('version');

            $contadorEdit = 3 - $maximaVersion;

            return view('contract_manager.ordenes-compra.editarOrdenCompra', compact('requisicion', 'proveedores', 'contratos', 'centro_costos', 'monedas', 'contrato', 'resultadoOrdenesCompra', 'contadorEdit'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function updateOrdenCompra(Request $request, $id)
    {
        $ordenCompra = KatbolRequsicion::findOrFail($id);

        $ordenCompra->update([
            'fecha_entrega' => $request->fecha_entrega,
            'pago' => $request->pago,
            'dias_credito' => $request->dias_credito,
            'moneda' => $request->moneda,
            'cambio' => $request->cambio,
            'proveedoroc_id' => $request->proveedor_id,
            'direccion_envio_proveedor' => $request->direccion_envio,
            'credito_proveedor' => $request->credito_proveedor,

            'estado_orden' => 'curso',

            'sub_total' => $request->sub_total,
            'iva' => $request->iva,
            'iva_retenido' => $request->iva_retenido,
            'isr_retenido' => $request->isr_retenido,
            'total' => $request->total,
        ]);

        $camposOrdenCompra = $this->camposOrdenesCompra(); // Obtener campos relevantes
        $idEmpleado = User::getCurrentUser()->empleado->id;

        // Obtener la versión actual de la orden de compra
        $versionOCId = DB::table('versiones_orden_compra')
            ->where('orden_compra_id', $ordenCompra->id)
            ->where('last_updated_at', '>=', now()->subMinutes(1))
            ->value('id');

        // Si no existe, crear una nueva versión
        if (! $versionOCId) {
            $ultimaVersionOrdenCompra = DB::table('versiones_orden_compra')
                ->where('orden_compra_id', $ordenCompra->id)
                ->orderBy('version', 'desc')
                ->first();

            $nuevaVersion = $ultimaVersionOrdenCompra ? $ultimaVersionOrdenCompra->version + 1 : 1;

            // Crear la nueva versión
            $versionOCId = DB::table('versiones_orden_compra')->insertGetId([
                'orden_compra_id' => $ordenCompra->id,
                'version' => $nuevaVersion,
                'created_at' => now(),
                'updated_at' => now(),
                'last_updated_at' => now(),
            ]);
        }

        // Obtener productos existentes para comparación
        $productosExistentes = KatbolProductoRequisicion::where('requisiciones_id', $ordenCompra->id)->get();
        $productosNuevos = [];

        // Procesar productos nuevos y detectar cambios
        for ($i = 1; $i <= $request->count_productos; $i++) {
            $productosNuevos[] = [
                'cantidad' => $request['cantidad' . $i],
                'producto_id' => $request['producto' . $i],
                'centro_costo_id' => $request['centro_costo' . $i],
                'espesificaciones' => $request['especificaciones' . $i],
                'contrato_id' => $request['contrato' . $i],
                'no_personas' => $request['no_personas' . $i],
                'porcentaje_involucramiento' => $request['porcentaje_involucramiento' . $i],
                'sub_total' => $request['sub_total' . $i],
                'iva' => $request['iva' . $i],
                'iva_retenido' => $request['iva_retenido' . $i],
                'descuento' => $request['descuento' . $i],
                'otro_impuesto' => $request['otro_impuesto' . $i],
                'isr_retenido' => $request['isr_retenido' . $i],
                'total' => $request['total' . $i],
            ];
        }

        // Detectar productos eliminados
        foreach ($productosExistentes as $productoExistente) {
            $encontrado = false;
            foreach ($productosNuevos as $productoNuevo) {
                if ($productoNuevo['producto_id'] == $productoExistente->producto_id) {
                    $encontrado = true;
                    break;
                }
            }

            if (! $encontrado) {
                // Registrar el cambio en el historial
                HistorialEdicionesOC::create([
                    'requisicion_id' => $ordenCompra->id,
                    'registro_tipo' => KatbolProductoRequisicion::class,
                    'id_empleado' => $idEmpleado,
                    'campo' => 'producto',
                    'valor_anterior' => $productoExistente->toJson(), // Estado anterior
                    'valor_nuevo' => 'Eliminado', // Estado nuevo
                    'version_id' => $versionOCId,
                ]);
                // Eliminar producto
                $productoExistente->delete();
            }
        }

        // Guardar nuevos productos y registrar cambios
        foreach ($productosNuevos as $productoNuevo) {
            // Verificar si ya existe el producto
            $productoExistente = KatbolProductoRequisicion::where('producto_id', $productoNuevo['producto_id'])
                ->where('requisiciones_id', $ordenCompra->id)
                ->first();

            if (! $productoExistente) {
                // Crear nuevo producto
                $nuevoProducto = KatbolProductoRequisicion::create(array_merge($productoNuevo, [
                    'requisiciones_id' => $ordenCompra->id,
                ]));

                // Registrar el cambio en el historial
                HistorialEdicionesOC::create([
                    'requisicion_id' => $ordenCompra->id,
                    'registro_tipo' => KatbolProductoRequisicion::class,
                    'id_empleado' => $idEmpleado,
                    'campo' => 'producto',
                    'valor_anterior' => 'Creado', // Estado anterior
                    'valor_nuevo' => $nuevoProducto->toJson(), // Estado nuevo
                    'version_id' => $versionOCId,
                ]);
            } else {
                // Comparar y detectar cambios en los campos
                foreach ($productoNuevo as $campo => $nuevoValor) {
                    $valorAnterior = $productoExistente->{$campo};

                    if ($valorAnterior !== $nuevoValor) {
                        // Registrar el cambio en el historial
                        HistorialEdicionesOC::create([
                            'requisicion_id' => $ordenCompra->id,
                            'registro_tipo' => KatbolProductoRequisicion::class,
                            'id_empleado' => $idEmpleado,
                            'campo' => $campo,
                            'valor_anterior' => $valorAnterior, // Valor anterior
                            'valor_nuevo' => $nuevoValor, // Valor nuevo
                            'version_id' => $versionOCId,
                        ]);
                    }
                }
            }
        }

        // Aquí puedes continuar con el resto de la lógica de la función updateOrdenCompra, si es necesario
        $proveedor = KatbolProveedorOC::where('id', $request->proveedor_id)->first();

        $ordenCompra->update([
            'proveedor_catalogo_oc' => $proveedor->nombre,
        ]);

        $proveedor->update([
            'direccion' => $request->direccion,
            'facturacion' => $request->facturacion,
            'envio' => $request->direccion_envio,
            'credito' => $request->credito_proveedor,
        ]);

        return redirect(route('contract_manager.orden-compra.firmarAprobadores', ['id' => $ordenCompra->id]));
    }

    public function camposOrdenesCompra()
    {
        return [
            'fecha_entrega',
            'pago',
            'dias_credito',
            'moneda',
            'cambio',
            'proveedor_id',
            'direccion_envio_proveedor',
            'credito_proveedor',
            'sub_sub_total',
            'sub_iva',
            'sub_iva_retenido',
            'sub_descuento',
            'sub_otro',
            'sub_isr',
            'sub_total_total',
            'sub_total',
            'iva',
            'iva_retenido',
            'isr_retenido',
            'total',
            'id_user',
            //  'firma_solicitante_orden',
            //  'firma_finanzas_orden',
            //  'firma_comprador_orden',
            'facturacion',
            'direccion',
            //  'estado_orden',
            //  'estado_orden_dos',
            //  'proveedor_catalogo',
            'proveedor_catalogo_oc',
            'proveedor_catalogo_id',
            'ids_proveedores',
            'proveedoroc_id',
        ];
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

                if ($responsableNivel) {
                    if ($responsableNivel->empleado->disponibilidad->disponibilidad == 1) {

                        $responsable = $responsableNivel->empleado;
                        $userEmail = $responsable->email;

                        $cN = $listaPart->where('nivel', $i)->where('numero_orden', '!=', 1);

                        foreach ($cN as $key => $c) {
                            $copiasNivel[] = removeUnicodeCharacters($c->empleado->email);
                        }

                        break;
                    } else {
                        // Si el responsable está ausente, lo añadimos a la lista de ausentes
                        $responsablesAusentes[] = removeUnicodeCharacters($responsableNivel->empleado->email);
                    }
                }
            }

            $correosCopia = array_merge($copiasNivel, $responsablesAusentes);

            try {

                Mail::to($this->removeUnicodeCharacters($userEmail))->cc($correosCopia)->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
            } catch (\Throwable $th) {
                return view('errors.alerta_error', compact('th'));
            }
        }
        if ($tipo_firma == 'firma_comprador_orden') {
            $fecha = date('d-m-Y');
            $requisicion->fecha_firma_comprador_orden = $fecha;
            $requisicion->save();

            // correo de finanzas
            $userEmail = $requisicion->email;
            $organizacion = Organizacion::getFirst();
            Mail::to(removeUnicodeCharacters($userEmail))->cc($correosCopia)->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));
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
                $correos_informados[] = removeUnicodeCharacters($informado->empleado->email);
            }

            foreach ($listaInformativa->usuarios as $key => $informado) {
                $correos_informados[] = removeUnicodeCharacters($informado->usuario->email);
            }

            $organizacionInformado = Organizacion::getFirst();
            Mail::to($correos_informados)->queue(new OrdenCompraAprobada($requisicion, $organizacionInformado, $orden_correo));
        }

        Mail::to(removeUnicodeCharacters($userEmail))->cc($correosCopia)->queue(new RequisicionesEmail($requisicion, $organizacion, $tipo_firma));

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

        $proveedores = KatbolProveedorOC::where('id', $requisiciones->proveedoroc_id)->first();
        $pdf = PDF::loadView('orden_compra_pdf', compact('firma_finanzas_name', 'requisiciones', 'organizacion', 'proveedores', 'letras'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('orden_compra.pdf');
    }

    public function filtrarPorEstado3()
    {
        $buttonSolicitante = false;
        $buttonFinanzas = false;
        $buttonCompras = true;
        $user = User::getCurrentUser();
        $empleadoActual = $user->empleado;

        if ($user->roles->contains('title', 'Admin') || $user->can('visualizar_todas_orden_compra')) {
            $requisiciones = KatbolRequsicion::getOCAll()->where('firma_comprador_orden', null);
            toast('Filtro compradores aplicado!', 'success');
        } else {
            $requisiciones = KatbolRequsicion::ordenesCompraAprobador($empleadoActual->id, 'comprador');
            toast('Filtro compradores aplicado!', 'success');
        }

        return view('contract_manager.ordenes-compra.aprobadores', compact('requisiciones', 'buttonSolicitante', 'buttonFinanzas', 'buttonCompras'));
    }

    public function filtrarPorEstado2()
    {

        $buttonSolicitante = true;
        $buttonFinanzas = false;
        $buttonCompras = false;

        $user = User::getCurrentUser();
        $empleadoActual = $user->empleado;

        if ($user->roles->contains('title', 'Admin') || $user->can('visualizar_todas_orden_compra')) {
            $requisiciones = KatbolRequsicion::getOCAll()->whereNotNull('firma_comprador_orden')->where('firma_solicitante_orden', null);
            toast('Filtro solicitante aplicado!', 'success');
        } else {
            $requisiciones = KatbolRequsicion::ordenesCompraAprobador($empleadoActual->id, 'solicitante');
            toast('Filtro solicitante aplicado!', 'success');
        }

        return view('contract_manager.ordenes-compra.aprobadores', compact('requisiciones', 'buttonSolicitante', 'buttonFinanzas', 'buttonCompras'));
    }

    public function filtrarPorEstado()
    {

        $buttonSolicitante = false;
        $buttonFinanzas = true;
        $buttonCompras = false;

        $user = User::getCurrentUser();
        $empleadoActual = $user->empleado;

        if ($user->roles->contains('title', 'Admin') || $user->can('visualizar_todas_orden_compra')) {

            $requisiciones = KatbolRequsicion::getOCAll()->whereNotNull('firma_solicitante_orden')->whereNotNull('firma_comprador_orden')->where('firma_finanzas_orden', null);
            toast('Filtro finanzas aplicado!', 'success');
        } else {
            $requisiciones = KatbolRequsicion::ordenesCompraAprobador($empleadoActual->id, 'finanzas');
            toast('Filtro finanzas aplicado!', 'success');
        }

        return view('contract_manager.ordenes-compra.aprobadores', compact('requisiciones', 'buttonSolicitante', 'buttonFinanzas', 'buttonCompras'));
    }

    public function indexAprobadores()
    {
        $proveedor_indistinto = KatbolProveedorIndistinto::pluck('requisicion_id')->first();
        $buttonSolicitante = false;
        $buttonFinanzas = false;
        $buttonCompras = false;

        $user = User::getCurrentUser();
        $empleadoActual = $user->empleado;

        if ($user->roles->contains('title', 'Admin') || $user->can('visualizar_todas_orden_compra')) {
            $requisiciones = KatbolRequsicion::with('contrato', 'provedores_requisiciones')->where([
                ['firma_solicitante', '!=', null],
                ['firma_jefe', '!=', null],
                ['firma_finanzas', '!=', null],
                ['firma_compras', '!=', null],
            ])->where('archivo', false)->orderByDesc('id')
                ->get();
        } else {
            $requisiciones = KatbolRequsicion::ordenesCompraAprobador($empleadoActual->id, 'general');
        }

        return view('contract_manager.ordenes-compra.aprobadores', compact('requisiciones', 'proveedor_indistinto', 'buttonSolicitante', 'buttonFinanzas', 'buttonCompras'));
    }

    public function firmarAprobadores($id)
    {
        $bandera = true;
        $requisicion = KatbolRequsicion::getOCAll()->where('id', $id)->first();

        $user = User::getCurrentUser();
        $supervisor = User::find($requisicion->id_user)->empleado->supervisor->name;
        $supervisor_email = User::find($requisicion->id_user)->empleado->supervisor->email;

        $responsableComprador = KatbolComprador::with('user')->where('id', $requisicion->comprador_id)->first();

        $comprador = $this->obtenerComprador($responsableComprador);

        $solicitante = User::find($requisicion->id_user);

        if ($requisicion->firma_comprador_orden === null) {
            if (removeUnicodeCharacters($comprador->email) === removeUnicodeCharacters($user->email)) {
                $tipo_firma = 'firma_comprador_orden';
            } else {
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del comprador directo: <br> <strong>' . $comprador->name . '</strong>');
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
            if (removeUnicodeCharacters($comprador->email) === removeUnicodeCharacters($user->email)) {
                $tipo_firma = 'firma_comprador_orden';
            } else {
                return view('contract_manager.ordenes-compra.error')->with('mensaje', 'No tiene permisos para firmar<br> En espera del comprador: <br> <strong>' . $comprador->name . '</strong>');
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

    public function obtenerComprador($comprador)
    {
        $listaReq = ListaDistribucion::where('modelo', 'Comprador')->first();
        $listaPart = $listaReq->participantes;

        $responsableOG = $listaPart->where('numero_orden', 1)->where('empleado_id', $comprador->user->id)->first();
        $n_part_nivel = $listaPart->where('nivel', $responsableOG->nivel)->count();

        for ($i = 1; $i <= $n_part_nivel; $i++) {
            $responsableNivel = $listaPart->where('nivel', $responsableOG->nivel)->where('numero_orden', $i)->first();

            if ($responsableNivel) {
                if ($responsableNivel->empleado->disponibilidad->disponibilidad == 1) {

                    $responsable = $responsableNivel->empleado;

                    break;
                }
            }
        }

        return $responsable;
    }

    public function cancelarOrdenCompra(Request $request)
    {
        try {
            $oc = KatbolRequsicion::findOrFail($request->id);

            $oc->update([
                'estado_orden' => 'cancelada',
                'firma_solicitante_orden' => null,
                'firma_finanzas_orden' => null,
                'firma_comprador_orden' => null,
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Error al cancelar la requisición.'], 500);
        }
    }
}
