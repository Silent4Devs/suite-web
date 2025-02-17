<?php

namespace App\Models\ContractManager;

use App\Models\FirmasRequisiciones;
use App\Models\HistorialEdicionesOC;
use App\Models\HistorialEdicionesReq;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class Requsicion extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'fecha',
        'entrega',
        'estatus',
        'referencia',
        'descripcion',
        'estado',
        'cantidad',
        'file',
        'contrato_id',
        'comprador_id',
        'sucursal_id',
        'producto_id',
        'firma_solicitante',
        'firma_finanzas',
        'firma_jefe',
        'firma_compras',
        'user',
        'area',
        'archivo',
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
        'firma_solicitante_orden',
        'firma_finanzas_orden',
        'firma_comprador_orden',
        'facturacion',
        'direccion',
        'estado_orden',
        'estado_orden_dos',
        'proveedor_catalogo',
        'proveedor_catalogo_oc',
        'proveedor_catalogo_id',
        'ids_proveedores',
        'proveedoroc_id',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'folio',
        'contador_version_orden_compra',
        'obtener_responsable_lider',
        'obtener_responsable_finanzas',
        'obtener_responsable_comprador',
        'obtener_responsable_finanzas_orden_compra',
        'lista_sustitutos',
    ];

    public $table = 'requisiciones';

    protected $with = ['productos_requisiciones', 'provedores_requisiciones'];

    public function camposRequisiciones()
    {
        return [
            'fecha',
            'estatus',
            'referencia',
            'descripcion',
            // 'estado',
            'cantidad',
            'contrato_id',
            'comprador_id',
            'sucursal_id',
            'producto_id',
            // 'firma_solicitante',
            // 'firma_finanzas',
            // 'firma_jefe',
            // 'firma_compras',
            'user',
            'area',
            'archivo',
            'proveedor_id',
            'id_user',
            // 'proveedor_catalogo',
            'proveedor_catalogo_oc',
            'proveedor_catalogo_id',
            'ids_proveedores',
            'proveedoroc_id',
            'email',
        ];
    }

    // Campos específicos para el Módulo 1
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

    protected static $ignorarHistorial = false;

    // Función para desactivar el histórico
    public static function desactivarHistorial()
    {
        self::$ignorarHistorial = true;
    }

    // Función para activar el histórico
    public static function activarHistorial()
    {
        self::$ignorarHistorial = false;
    }

    protected static function booted()
    {
        static::updating(function ($registro) {
            // Verificar si la bandera está activada para ignorar la creación de historial
            if (self::$ignorarHistorial) {
                return;
            }

            $idEmpleado = User::getCurrentUser()->empleado->id;
            $camposRequisiciones = $registro->camposRequisiciones();
            $camposOrdenesCompra = $registro->camposOrdenesCompra();

            // Obtener la última versión activa si existe y si fue creada/actualizada en los últimos X minutos
            $versionReqId = DB::table('versiones_requisicion')
                ->where('requisicion_id', $registro->id)
                ->where('last_updated_at', '>=', now()->subMinutes(1))
                ->value('id');

            $versionOCId = DB::table('versiones_orden_compra')
                ->where('orden_compra_id', $registro->id)
                ->where('last_updated_at', '>=', now()->subMinutes(1))
                ->value('id');

            $nuevaVersionReq = false;
            $nuevaVersionOC = false;

            // Verificamos si hay cambios en los campos de requisición
            $hayCambiosRequisicion = false;
            foreach ($registro->getDirty() as $campo => $nuevoValor) {
                if (in_array($campo, $camposRequisiciones)) {
                    $hayCambiosRequisicion = true;
                    break;
                }
            }

            // Verificamos si hay cambios en los campos de orden de compra
            $hayCambiosOrdenCompra = false;
            foreach ($registro->getDirty() as $campo => $nuevoValor) {
                if (in_array($campo, $camposOrdenesCompra)) {
                    $hayCambiosOrdenCompra = true;
                    break;
                }
            }

            // Si no hay una versión reciente de requisición y hay cambios, creamos una nueva versión
            if (! $versionReqId && $hayCambiosRequisicion) {
                $ultimaVersionRequisicion = DB::table('versiones_requisicion')
                    ->where('requisicion_id', $registro->id)
                    ->orderBy('version', 'desc')
                    ->first();

                $nuevaVersion = $ultimaVersionRequisicion ? $ultimaVersionRequisicion->version + 1 : 1;

                // Crear la nueva versión
                $versionReqId = DB::table('versiones_requisicion')->insertGetId([
                    'requisicion_id' => $registro->id,
                    'version' => $nuevaVersion,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'last_updated_at' => now(),
                ]);

                $nuevaVersionReq = true;
            }

            // Solo crear una nueva versión de orden de compra si hay cambios reales
            if (! $versionOCId && $hayCambiosOrdenCompra) {
                $ultimaVersionOrdenCompra = DB::table('versiones_orden_compra')
                    ->where('orden_compra_id', $registro->id)
                    ->orderBy('version', 'desc')
                    ->first();

                $nuevaVersion = $ultimaVersionOrdenCompra ? $ultimaVersionOrdenCompra->version + 1 : 1;

                // Crear la nueva versión
                $versionOCId = DB::table('versiones_orden_compra')->insertGetId([
                    'orden_compra_id' => $registro->id,
                    'version' => $nuevaVersion,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'last_updated_at' => now(),
                ]);

                $nuevaVersionOC = true;
            }

            // Iteramos por los cambios para registrar cada uno en el historial
            foreach ($registro->getDirty() as $campo => $nuevoValor) {
                $valorAnterior = $registro->getOriginal($campo);

                if (in_array($campo, $camposRequisiciones) && $versionReqId) {
                    // Crear el registro en la tabla de historial de requisiciones
                    HistorialEdicionesReq::create([
                        'requisicion_id' => $registro->id,
                        'registro_tipo' => self::class,
                        'id_empleado' => $idEmpleado,
                        'campo' => $campo,
                        'valor_anterior' => $valorAnterior,
                        'valor_nuevo' => $nuevoValor,
                        'version_id' => $versionReqId,
                    ]);
                } elseif (in_array($campo, $camposOrdenesCompra) && $versionOCId) {
                    // Verificar si el cambio es significativo antes de crear el historial
                    if ($hayCambiosOrdenCompra) {
                        // Crear el registro en la tabla de historial de órdenes de compra
                        HistorialEdicionesOC::create([
                            'requisicion_id' => $registro->id,
                            'registro_tipo' => self::class,
                            'id_empleado' => $idEmpleado,
                            'campo' => $campo,
                            'valor_anterior' => $valorAnterior,
                            'valor_nuevo' => $nuevoValor,
                            'version_id' => $versionOCId,
                        ]);
                    }
                }
            }

            // Actualizar la columna last_updated_at de la versión si se creó o reutilizó una
            if ($nuevaVersionReq || $versionReqId) {
                DB::table('versiones_requisicion')
                    ->where('id', $versionReqId)
                    ->update(['last_updated_at' => now()]);
            }

            if ($nuevaVersionOC || $versionOCId) {
                DB::table('versiones_orden_compra')
                    ->where('id', $versionOCId)
                    ->update(['last_updated_at' => now()]);
            }
        });
    }

    // Relación con el historial de ediciones de requisiciones
    public function historialesRequisicion()
    {
        return $this->hasMany(HistorialEdicionesReq::class, 'requisicion_id');
    }

    // Relación con el historial de ediciones de órdenes de compra
    public function historialesOrdenCompra()
    {
        return $this->hasMany(HistorialEdicionesOC::class, 'requisicion_id');
    }

    // Redis methods
    public static function getAll()
    {
        return Cache::remember('Requisiciones:all', 3600 * 8, function () {
            return self::with('registroFirmas')->orderByDesc('id')->get();
        });
    }

    public static function getArchivoFalseAll()
    {
        return Cache::remember('Requisiciones:archivo_false_all', 3600 * 8, function () {
            return self::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto', 'provedores_requisiciones', 'provedores_indistintos_requisiciones', 'provedores_requisiciones_catalogo', 'registroFirmas')->where('archivo', false)->orderByDesc('id')->get();
        });
    }

    public static function getOCAll()
    {
        return Cache::remember('Requisiciones:ordenes_compra_false', 3600 * 8, function () {
            return self::with('contrato', 'provedores_requisiciones')->where([
                ['firma_solicitante', '!=', null],
                ['firma_jefe', '!=', null],
                ['firma_finanzas', '!=', null],
                ['firma_compras', '!=', null],
            ])->where('archivo', false)->orderByDesc('id')
                ->get();
        });
    }

    public static function getArchivoTrueAll()
    {
        return Cache::remember('Requisiciones:archivo_true_all', 3600 * 8, function () {
            return self::with('contrato', 'comprador.user', 'sucursal', 'productos_requisiciones.producto', 'provedores_requisiciones', 'provedores_indistintos_requisiciones', 'provedores_requisiciones_catalogo', 'registroFirmas')->where('archivo', true)->orderByDesc('id')->get();
        });
    }

    public static function requisicionesAprobador($id_empleado, $filtro)
    {
        $requisiciones = self::with('registroFirmas')
            ->where('archivo', false)
            ->orderByDesc('id')
            ->get();

        $coleccion = collect();

        switch ($filtro) {
            case 'general':
                foreach ($requisiciones as $req) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($req->registroFirmas) {
                        $registro = $req->registroFirmas;

                        if ($registro->solicitante_id == $id_empleado && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }

                        if (! is_null($registro->solicitante_id) && $registro->jefe_id == $id_empleado && is_null($registro->responsable_finanzas_id) && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }

                        if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && $registro->responsable_finanzas_id == $id_empleado && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }

                        if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && $registro->comprador_id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    } else {

                        $user = User::getCurrentUser();

                        if ($req->id_user == $user->id && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $listaReqLider = ListaDistribucion::where('modelo', 'Empleado')->first();
                        $listaPartLider = $listaReqLider->participantes;

                        $jefe = $user->empleado->supervisor;
                        $supListLider = $listaPartLider->where('empleado_id', $jefe->id)->first();

                        $nivel = $supListLider->nivel;

                        $participantesNivelLider = $listaPartLider->where('nivel', $nivel)->sortBy('numero_orden');

                        foreach ($participantesNivelLider as $key => $partNivLider) {
                            if ($partNivLider->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableLider = $partNivLider->empleado;

                                break;
                            }
                        }

                        if (! is_null($req->firma_solicitante) && $responsableLider->id == $id_empleado && is_null($req->firma_finanzas) && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $listaReqFinanzas = ListaDistribucion::where('modelo', 'KatbolRequsicion')->first();
                        $listaPartFinanzas = $listaReqFinanzas->participantes;

                        for ($i = 0; $i <= $listaReqFinanzas->niveles; $i++) {

                            $responsableNivelFinanzas = $listaPartFinanzas->where('nivel', $i)->where('numero_orden', 1)->first();

                            if ($responsableNivelFinanzas->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableFinanzas = $responsableNivelFinanzas->empleado;

                                break;
                            }
                        }

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && $responsableFinanzas->id == $id_empleado && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $comprador = Comprador::with('user')->where('id', $req->comprador_id)->first();

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && $comprador->user->id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    }
                }
                break;

            case 'solicitante':
                // code...
                foreach ($requisiciones as $req) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($req->registroFirmas) {
                        $registro = $req->registroFirmas;

                        if ($registro->solicitante_id == $id_empleado && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }
                    } else {

                        $user = User::getCurrentUser();

                        if ($req->id_user == $user->id && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }
                    }
                }
                break;

            case 'jefe':
                // code...
                foreach ($requisiciones as $req) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($req->registroFirmas) {
                        $registro = $req->registroFirmas;

                        if (! is_null($registro->solicitante_id) && $registro->jefe_id == $id_empleado && is_null($registro->responsable_finanzas_id) && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }
                    } else {

                        $user = User::getCurrentUser();

                        $listaReqLider = ListaDistribucion::where('modelo', 'Empleado')->first();
                        $listaPartLider = $listaReqLider->participantes;

                        $jefe = $user->empleado->supervisor;
                        $supListLider = $listaPartLider->where('empleado_id', $jefe->id)->first();

                        $nivel = $supListLider->nivel;

                        $participantesNivelLider = $listaPartLider->where('nivel', $nivel)->sortBy('numero_orden');

                        foreach ($participantesNivelLider as $key => $partNivLider) {
                            if ($partNivLider->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableLider = $partNivLider->empleado;

                                break;
                            }
                        }

                        if (! is_null($req->firma_solicitante) && $responsableLider->id == $id_empleado && is_null($req->firma_finanzas) && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }
                    }
                }
                break;

            case 'finanzas':
                // code...
                foreach ($requisiciones as $req) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($req->registroFirmas) {
                        $registro = $req->registroFirmas;

                        if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && $registro->responsable_finanzas_id == $id_empleado && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }
                    } else {

                        $user = User::getCurrentUser();

                        $listaReqFinanzas = ListaDistribucion::where('modelo', 'KatbolRequsicion')->first();
                        $listaPartFinanzas = $listaReqFinanzas->participantes;

                        for ($i = 0; $i <= $listaReqFinanzas->niveles; $i++) {
                            $responsableNivelFinanzas = $listaPartFinanzas->where('nivel', $i)->where('numero_orden', 1)->first();

                            if ($responsableNivelFinanzas->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableFinanzas = $responsableNivelFinanzas->empleado;

                                break;
                            }
                        }

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && $responsableFinanzas->id == $id_empleado && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }
                    }
                }
                break;

            case 'comprador':
                // code...
                foreach ($requisiciones as $req) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($req->registroFirmas) {
                        $registro = $req->registroFirmas;

                        if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && $registro->comprador_id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    } else {

                        $comprador = Comprador::with('user')->where('id', $req->comprador_id)->first();

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && $comprador->user->id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    }
                }
                break;
            default:
                foreach ($requisiciones as $req) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($req->registroFirmas) {
                        $registro = $req->registroFirmas;

                        if ($registro->solicitante_id == $id_empleado && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }

                        if (! is_null($registro->solicitante_id) && $registro->jefe_id == $id_empleado && is_null($registro->responsable_finanzas_id) && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }

                        if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && $registro->responsable_finanzas_id == $id_empleado && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }

                        if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && $registro->comprador_id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    } else {

                        $user = User::getCurrentUser();

                        if ($req->id_user == $user->id && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $listaReqLider = ListaDistribucion::where('modelo', 'Empleado')->first();
                        $listaPartLider = $listaReqLider->participantes;

                        $jefe = $user->empleado->supervisor;
                        $supListLider = $listaPartLider->where('empleado_id', $jefe->id)->first();

                        $nivel = $supListLider->nivel;

                        $participantesNivelLider = $listaPartLider->where('nivel', $nivel)->sortBy('numero_orden');

                        foreach ($participantesNivelLider as $key => $partNivLider) {
                            if ($partNivLider->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableLider = $partNivLider->empleado;

                                break;
                            }
                        }

                        if (! is_null($req->firma_solicitante) && $responsableLider->id == $id_empleado && is_null($req->firma_finanzas) && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $listaReqFinanzas = ListaDistribucion::where('modelo', 'KatbolRequsicion')->first();
                        $listaPartFinanzas = $listaReqFinanzas->participantes;

                        for ($i = 0; $i <= $listaReqFinanzas->niveles; $i++) {
                            $responsableNivelFinanzas = $listaPartFinanzas->where('nivel', $i)->where('numero_orden', 1)->first();

                            if ($responsableNivelFinanzas->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableFinanzas = $responsableNivelFinanzas->empleado;

                                break;
                            }
                        }

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && $responsableFinanzas->id == $id_empleado && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $comprador = Comprador::with('user')->where('id', $req->comprador_id)->first();

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && $comprador->user->id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    }
                }
                break;
        }

        // Retornamos la colección al final
        return $coleccion;
    }

    public static function requisicionesAprobadorMobile($id_empleado, $filtro)
    {
        $requisiciones = self::getArchivoFalseAll();

        // dump($requisiciones);

        $coleccion = collect();

        switch ($filtro) {
            case 'general':
                foreach ($requisiciones as $req) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($req->registroFirmas) {
                        $registro = $req->registroFirmas;
                        // dump($registro);

                        if ($registro->solicitante_id == $id_empleado) {
                            // dd("1");
                            $coleccion->push($req);
                        }

                        if ($registro->jefe_id == $id_empleado) {
                            $coleccion->push($req);
                            // dump("2");

                        }

                        if ($registro->responsable_finanzas_id == $id_empleado) {
                            // dump("3");
                            $coleccion->push($req);
                        }

                        if ($registro->comprador_id == $id_empleado) {
                            // dd("4");

                            $coleccion->push($req);
                        }
                    } else {

                        $user = User::getCurrentUser();

                        if ($req->id_user == $user->id && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $listaReqLider = ListaDistribucion::where('modelo', 'Empleado')->first();
                        $listaPartLider = $listaReqLider->participantes;

                        $jefe = $user->empleado->supervisor;
                        $supListLider = $listaPartLider->where('empleado_id', $jefe->id)->first();

                        $nivel = $supListLider->nivel;

                        $participantesNivelLider = $listaPartLider->where('nivel', $nivel)->sortBy('numero_orden');

                        foreach ($participantesNivelLider as $key => $partNivLider) {
                            if ($partNivLider->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableLider = $partNivLider->empleado;

                                break;
                            }
                        }

                        if (! is_null($req->firma_solicitante) && $responsableLider->id == $id_empleado && is_null($req->firma_finanzas) && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $listaReqFinanzas = ListaDistribucion::where('modelo', 'KatbolRequsicion')->first();
                        $listaPartFinanzas = $listaReqFinanzas->participantes;

                        for ($i = 0; $i <= $listaReqFinanzas->niveles; $i++) {

                            $responsableNivelFinanzas = $listaPartFinanzas->where('nivel', $i)->where('numero_orden', 1)->first();

                            if ($responsableNivelFinanzas->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableFinanzas = $responsableNivelFinanzas->empleado;

                                break;
                            }
                        }

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && $responsableFinanzas->id == $id_empleado && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $comprador = Comprador::with('user')->where('id', $req->comprador_id)->first();

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && $comprador->user->id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    }
                }
                // dd($coleccion);
                break;

                // code...
                foreach ($requisiciones as $req) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($req->registroFirmas) {
                        $registro = $req->registroFirmas;

                        if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && $registro->comprador_id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    } else {

                        $comprador = Comprador::with('user')->where('id', $req->comprador_id)->first();

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && $comprador->user->id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    }
                }
                break;
            default:
                foreach ($requisiciones as $req) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($req->registroFirmas) {
                        $registro = $req->registroFirmas;

                        if ($registro->solicitante_id == $id_empleado && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }

                        if (! is_null($registro->solicitante_id) && $registro->jefe_id == $id_empleado && is_null($registro->responsable_finanzas_id) && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }

                        if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && $registro->responsable_finanzas_id == $id_empleado && is_null($registro->comprador_id)) {
                            $coleccion->push($req);
                        }

                        if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && $registro->comprador_id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    } else {

                        $user = User::getCurrentUser();

                        if ($req->id_user == $user->id && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $listaReqLider = ListaDistribucion::where('modelo', 'Empleado')->first();
                        $listaPartLider = $listaReqLider->participantes;

                        $jefe = $user->empleado->supervisor;
                        $supListLider = $listaPartLider->where('empleado_id', $jefe->id)->first();

                        $nivel = $supListLider->nivel;

                        $participantesNivelLider = $listaPartLider->where('nivel', $nivel)->sortBy('numero_orden');

                        foreach ($participantesNivelLider as $key => $partNivLider) {
                            if ($partNivLider->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableLider = $partNivLider->empleado;

                                break;
                            }
                        }

                        if (! is_null($req->firma_solicitante) && $responsableLider->id == $id_empleado && is_null($req->firma_finanzas) && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $listaReqFinanzas = ListaDistribucion::where('modelo', 'KatbolRequsicion')->first();
                        $listaPartFinanzas = $listaReqFinanzas->participantes;

                        for ($i = 0; $i <= $listaReqFinanzas->niveles; $i++) {
                            $responsableNivelFinanzas = $listaPartFinanzas->where('nivel', $i)->where('numero_orden', 1)->first();

                            if ($responsableNivelFinanzas->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableFinanzas = $responsableNivelFinanzas->empleado;

                                break;
                            }
                        }

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && $responsableFinanzas->id == $id_empleado && is_null($req->firma_compras)) {
                            $coleccion->push($req);
                        }

                        $comprador = Comprador::with('user')->where('id', $req->comprador_id)->first();

                        if (! is_null($req->firma_solicitante) && is_null($req->firma_jefe) && is_null($req->firma_finanzas) && $comprador->user->id == $id_empleado) {
                            $coleccion->push($req);
                        }
                    }
                }
                break;
        }

        // dd($coleccion);

        // Retornamos la colección al final
        return $coleccion;
    }

    public static function requisicionesArchivadas($id_empleado)
    {
        $requisiciones = self::with('registroFirmas')
            ->where('archivo', true)
            ->orderByDesc('id')
            ->get();

        $coleccion = collect();

        foreach ($requisiciones as $req) {
            // Verificamos si la relación `registroFirmas` existe y no es null
            if ($req->registroFirmas) {
                $registro = $req->registroFirmas;

                if ($registro->solicitante_id == $id_empleado && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && is_null($registro->comprador_id)) {
                    $coleccion->push($req);
                }

                if (! is_null($registro->solicitante_id) && $registro->jefe_id == $id_empleado && is_null($registro->responsable_finanzas_id) && is_null($registro->comprador_id)) {
                    $coleccion->push($req);
                }

                if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && $registro->responsable_finanzas_id == $id_empleado && is_null($registro->comprador_id)) {
                    $coleccion->push($req);
                }

                if (! is_null($registro->solicitante_id) && is_null($registro->jefe_id) && is_null($registro->responsable_finanzas_id) && $registro->comprador_id == $id_empleado) {
                    $coleccion->push($req);
                }
            }
        }

        // Retornamos la colección al final
        return $coleccion;
    }

    public static function ordenesCompraAprobador($id_empleado, $filtro)
    {
        $requisiciones = self::where('archivo', false)
            ->orderByDesc('id')
            ->get();

        $coleccion = collect();

        $ordenes = $requisiciones->where('firma_compras', '!=', null);

        switch ($filtro) {
            case 'general':
                foreach ($ordenes as $ord) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($ord->registroFirmas) {
                        $registro = $ord->registroFirmas;

                        if ($registro->comprador_id == $id_empleado && is_null($ord->firma_comprador_orden) && is_null($ord->firma_solicitante_orden) && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }

                        if (! is_null($ord->firma_comprador_orden) && $registro->solicitante_id == $id_empleado && is_null($ord->firma_solicitante_orden) && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }

                        if (! is_null($ord->firma_comprador_orden) && ! is_null($ord->firma_solicitante_orden) && $registro->responsable_finanzas_id == $id_empleado && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }
                    } else {

                        $user = User::getCurrentUser();

                        if ($ord->id_user == $user->id && is_null($ord->firma_comprador_orden) && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }

                        $listaOrdFinanzas = ListaDistribucion::where('modelo', 'OrdenCompra')->first();
                        $listaPartFinanzas = $listaOrdFinanzas->participantes;

                        for ($i = 0; $i <= $listaOrdFinanzas->niveles; $i++) {
                            $responsableNivelFinanzas = $listaPartFinanzas->where('nivel', $i)->where('numero_orden', 1)->first();

                            if ($responsableNivelFinanzas && $responsableNivelFinanzas->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableFinanzas = $responsableNivelFinanzas->empleado;

                                break;
                            }
                        }

                        if (
                            ! is_null($ord->firma_solicitante_orden)
                            && isset($responsableFinanzas)
                            && $responsableFinanzas->id == $id_empleado
                            && is_null($ord->firma_comprador_orden)
                        ) {

                            $coleccion->push($ord);
                        }

                        $comprador = Comprador::with('user')->where('id', $ord->comprador_id)->first();

                        if (! is_null($ord->firma_solicitante) && is_null($ord->firma_finanzas_orden) && $comprador->user->id == $id_empleado) {
                            $coleccion->push($ord);
                        }
                    }
                }
                break;

            case 'comprador':
                // code...
                foreach ($ordenes as $ord) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($ord->registroFirmas) {
                        $registro = $ord->registroFirmas;

                        if ($registro->comprador_id == $id_empleado && is_null($ord->firma_comprador_orden) && is_null($ord->firma_solicitante_orden) && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }
                    } else {
                        $comprador = Comprador::with('user')->where('id', $ord->comprador_id)->first();

                        if (! is_null($ord->firma_solicitante) && is_null($ord->firma_finanzas_orden) && $comprador->user->id == $id_empleado) {
                            $coleccion->push($ord);
                        }
                    }
                }
                break;

            case 'solicitante':
                // code...
                foreach ($ordenes as $ord) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($ord->registroFirmas) {
                        $registro = $ord->registroFirmas;

                        if (! is_null($ord->firma_comprador_orden) && $registro->solicitante_id == $id_empleado && is_null($ord->firma_solicitante_orden) && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }
                    } else {

                        $user = User::getCurrentUser();

                        if ($ord->id_user == $user->id && is_null($ord->firma_comprador_orden) && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }
                    }
                }
                break;

            case 'finanzas':
                // code...
                foreach ($ordenes as $ord) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($ord->registroFirmas) {
                        $registro = $ord->registroFirmas;

                        if (! is_null($ord->firma_comprador_orden) && ! is_null($ord->firma_solicitante_orden) && $registro->responsable_finanzas_id == $id_empleado && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }
                    } else {
                        $listaOrdFinanzas = ListaDistribucion::where('modelo', 'OrdenCompra')->first();
                        $listaPartFinanzas = $listaOrdFinanzas->participantes;

                        for ($i = 0; $i <= $listaOrdFinanzas->niveles; $i++) {
                            $responsableNivelFinanzas = $listaPartFinanzas->where('nivel', $i)->where('numero_orden', 1)->first();

                            if ($responsableNivelFinanzas->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableFinanzas = $responsableNivelFinanzas->empleado;

                                break;
                            }
                        }

                        if (! is_null($ord->firma_solicitante_orden) && $responsableFinanzas->id == $id_empleado && is_null($ord->firma_comprador_orden)) {
                            $coleccion->push($ord);
                        }
                    }
                }
                break;

            default:
                foreach ($ordenes as $ord) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($ord->registroFirmas) {
                        $registro = $ord->registroFirmas;

                        if ($registro->comprador_id == $id_empleado && is_null($ord->firma_comprador_orden) && is_null($ord->firma_solicitante_orden) && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }

                        if (! is_null($ord->firma_comprador_orden) && $registro->solicitante_id == $id_empleado && is_null($ord->firma_solicitante_orden) && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }

                        if (! is_null($ord->firma_comprador_orden) && ! is_null($ord->firma_solicitante_orden) && $registro->responsable_finanzas_id == $id_empleado && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }
                    }
                }
                break;
        }

        // Retornamos la colección al final
        return $coleccion;
    }

    public static function ordenesCompraAprobadorMobile($id_empleado, $filtro)
    {
        $requisiciones = self::where('archivo', false)
            ->orderByDesc('id')
            ->get();

        $coleccion = collect();

        $ordenes = $requisiciones->where('firma_compras', '!=', null);

        switch ($filtro) {
            case 'general':
                foreach ($ordenes as $ord) {
                    // Verificamos si la relación `registroFirmas` existe y no es null
                    if ($ord->registroFirmas) {
                        $registro = $ord->registroFirmas;

                        if ($registro->comprador_id == $id_empleado) {
                            $coleccion->push($ord);
                        }

                        if ($registro->solicitante_id == $id_empleado) {
                            $coleccion->push($ord);
                        }

                        if ($registro->responsable_finanzas_id == $id_empleado) {
                            $coleccion->push($ord);
                        }
                    } else {

                        $user = User::getCurrentUser();

                        if ($ord->id_user == $user->id && is_null($ord->firma_comprador_orden) && is_null($ord->firma_finanzas_orden)) {
                            $coleccion->push($ord);
                        }

                        $listaOrdFinanzas = ListaDistribucion::where('modelo', 'OrdenCompra')->first();
                        $listaPartFinanzas = $listaOrdFinanzas->participantes;

                        for ($i = 0; $i <= $listaOrdFinanzas->niveles; $i++) {
                            $responsableNivelFinanzas = $listaPartFinanzas->where('nivel', $i)->where('numero_orden', 1)->first();

                            if ($responsableNivelFinanzas->empleado->disponibilidad->disponibilidad == 1) {

                                $responsableFinanzas = $responsableNivelFinanzas->empleado;

                                break;
                            }
                        }

                        if (! is_null($ord->firma_solicitante_orden) && $responsableFinanzas->id == $id_empleado && is_null($ord->firma_comprador_orden)) {
                            $coleccion->push($ord);
                        }

                        $comprador = Comprador::with('user')->where('id', $ord->comprador_id)->first();

                        if (! is_null($ord->firma_solicitante) && is_null($ord->firma_finanzas_orden) && $comprador->user->id == $id_empleado) {
                            $coleccion->push($ord);
                        }
                    }
                }
                break;
        }

        // Retornamos la colección al final
        return $coleccion;
    }

    // relacion-contrato
    public function contrato()
    {
        return $this->hasOne(Contrato::class, 'id', 'contrato_id');
    }

    // relacion-comprador
    public function userSolicitante()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    // relacion-comprador
    public function comprador()
    {
        return $this->hasOne(Comprador::class, 'id', 'comprador_id');
    }

    // relacion-sucursal
    public function sucursal()
    {
        return $this->hasOne(Sucursal::class, 'id', 'sucursal_id');
    }

    // relacion-productos_requisiciones
    public function productos_requisiciones()
    {
        return $this->hasMany(ProductoRequisicion::class, 'requisiciones_id', 'id')->orderBy('id');
    }

    // relacion-provedores_requisiciones
    public function provedores_requisiciones()
    {
        return $this->hasMany(ProveedorRequisicion::class, 'requisiciones_id', 'id')->orderBy('id');
    }

    // relacion-provedores_requisiciones
    public function provedores_indistintos_requisiciones()
    {
        return $this->hasMany(ProveedorIndistinto::class, 'requisicion_id', 'id')->orderBy('id');
    }

    // relacion-provedores_requisiciones
    public function provedores_requisiciones_catalogo()
    {
        return $this->hasMany(ProvedorRequisicionCatalogo::class, 'requisicion_id', 'id')->orderBy('id');
    }

    public function proveedor()
    {
        return $this->belongsTo(ProveedorOC::class, 'proveedor_id', 'id');
    }

    public function proveedorOC()
    {
        return $this->belongsTo(ProveedorOC::class, 'proveedoroc_id', 'id');
    }

    public function registroFirmas()
    {
        return $this->hasOne(FirmasRequisiciones::class, 'requisicion_id', 'id');
    }

    public function getFolioAttribute()
    {
        $numero = $this->id;

        $parte1 = floor($numero / 10000) % 100;
        $parte2 = $numero % 10000;

        if ($this->estado == 'firmada' || $this->estado_orden == 'rechazado_oc' || $this->estado_orden == 'curso' || $this->estado_orden == 'fin') {
            $tipo = 'OC-';
        } else {
            $tipo = 'RQ-';
        }

        $codigo = $tipo.sprintf('%02d-%04d', $parte1, $parte2);

        return $codigo;
    }

    public function getContadorVersionOrdenCompraAttribute()
    {
        // En el controlador para órdenes de compra
        $historialesOrdenCompra = HistorialEdicionesOC::with('version', 'empleado')->where('requisicion_id', $this->id)->get();

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

        return $contadorEdit;
    }

    public function getObtenerResponsableLiderAttribute()
    {

        $requisicion = self::where('id', $this->id)->first();

        if (isset($requisicion->registroFirmas->delegado_jefe_id)) {

            $responsable = $requisicion->registroFirmas->delegadoJefe;

            return $responsable; // Retornar el responsable si se encuentra disponible
        } else {
            $user = User::where('id', $requisicion->id_user)->first();

            $listaReq = ListaDistribucion::where('modelo', 'Empleado')->first();
            $listaPart = $listaReq->participantes;

            // Validar que $user y $user->empleado existen antes de acceder a $supervisor
            $jefe = $user?->empleado?->supervisor;

            if (is_null($jefe)) {
                return null; // Retornar null si $jefe no está definido
            }

            $supList = $listaPart->where('empleado_id', $jefe->id)->where('numero_orden', 1)->first();

            $nivel = $supList->nivel ?? null; // Asignar null si no está definido

            // Validar si $nivel es nulo
            if (is_null($nivel)) {
                return $jefe; // Retornar $jefe si $nivel no está definido
            }

            // Filtrar participantes por nivel
            $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

            // Recorrer los participantes filtrados
            foreach ($participantesNivel as $key => $partNiv) {
                if ($partNiv->empleado->disponibilidad->disponibilidad == 1) {
                    $responsable = $partNiv->empleado;

                    return $responsable; // Retornar el responsable si se encuentra disponible
                }
            }

            // Si no se encuentra responsable disponible, retornar $jefe
            return $jefe;

        }
    }

    public function getObtenerResponsableFinanzasAttribute()
    {
        $requisicion = self::where('id', $this->id)->first();

        if (isset($requisicion->registroFirmas->delegado_finanzas_id)) {

            $responsable = $requisicion->registroFirmas->delegadoResponsableFinanzas;

            return $responsable; // Retornar el responsable si se encuentra disponible
        } else {
            $listaReq = ListaDistribucion::where('modelo', 'KatbolRequsicion')->first();
            $listaPart = $listaReq->participantes;

            for ($i = 0; $i <= $listaReq->niveles; $i++) {
                $responsableNivel = $listaPart->where('nivel', $i)->where('numero_orden', 1)->first();

                if ($responsableNivel->empleado->disponibilidad->disponibilidad == 1) {

                    $responsable = $responsableNivel->empleado;

                    return $responsable;
                }
            }

            return false;
        }
    }

    public function getObtenerResponsableCompradorAttribute()
    {
        $requisicion = self::where('id', $this->id)->first();

        if (isset($requisicion->registroFirmas->delegado_comprador_id)) {

            $responsable = $requisicion->registroFirmas->delegadoComprador;

            return $responsable; // Retornar el responsable si se encuentra disponible
        } else {

            $comprador = Comprador::with('user')->where('id', $this->comprador_id)->first();

            if (! $comprador || ! $comprador->user) {
                return false; // Validación para evitar intentar acceder a una propiedad de null
            }

            $listaReq = ListaDistribucion::where('modelo', 'Comprador')->first();

            if (! $listaReq || ! $listaReq->participantes) {
                return false; // Validación adicional para asegurar que la lista y sus participantes existan
            }

            $listaPart = $listaReq->participantes;

            $supList = $listaPart->where('empleado_id', $comprador->user->id)->where('numero_orden', 1)->first();

            if (! $supList || ! $supList->nivel) {
                return false; // Validación para verificar que $supList y su nivel existan
            }

            $nivel = $supList->nivel;

            $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

            foreach ($participantesNivel as $key => $partNiv) {
                if (
                    isset($partNiv->empleado) &&
                    isset($partNiv->empleado->disponibilidad) &&
                    $partNiv->empleado->disponibilidad->disponibilidad == 1
                ) {
                    $responsable = $partNiv->empleado;

                    return $responsable;
                }
            }

            return false;

        }
    }

    public function getListaSustitutosAttribute()
    {

        $requisicion = self::where('id', $this->id)->first();

        $empleadoActual = User::getCurrentUser()->empleado;

        if ($requisicion->firma_jefe === null) {

            $user = User::where('id', $requisicion->id_user)->first();

            $listaReq = ListaDistribucion::where('modelo', 'Empleado')->first();
            $listaPart = $listaReq->participantes;

            $jefe = $user->empleado->supervisor;
            $supList = $listaPart->where('empleado_id', $jefe->id)->where('numero_orden', 1)->first();

            $nivel = $supList->nivel ?? null; // Asignar null si no está definido

            $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

            $sustitutosLD = [];
            foreach ($participantesNivel as $key => $participante) {
                if ($participante->empleado->disponibilidad->disponibilidad == 1 && $participante->empleado->id != $empleadoActual->id) {
                    $sustitutosLD[] = $participante->empleado;
                }
            }

            return $sustitutosLD;
        } elseif ($requisicion->firma_finanzas === null) {

            $LD = ListaDistribucion::where('modelo', 'KatbolRequsicion')->first();
            $participantes = $LD->participantes;
            $sustitutosLD = [];
            foreach ($participantes as $key => $participante) {
                if ($participante->empleado->disponibilidad->disponibilidad == 1 && $participante->empleado->id != $empleadoActual->id) {
                    $sustitutosLD[] = $participante->empleado;
                }
            }

            return $sustitutosLD;
        } elseif ($requisicion->firma_compras === null) {

            $comprador = Comprador::with('user')->where('id', $this->comprador_id)->first();

            $listaReq = ListaDistribucion::where('modelo', 'Comprador')->first();
            $listaPart = $listaReq->participantes;

            $supList = $listaPart->where('empleado_id', $comprador->user->id)->where('numero_orden', 1)->first();

            $nivel = $supList->nivel;

            $participantesNivel = $listaPart->where('nivel', $nivel)->sortBy('numero_orden');

            $sustitutosLD = [];
            foreach ($participantesNivel as $key => $participante) {
                if ($participante->empleado->disponibilidad->disponibilidad == 1 && $participante->empleado->id != $empleadoActual->id) {
                    $sustitutosLD[] = $participante->empleado;
                }
            }

            return $sustitutosLD;
        }
    }

    public function getObtenerResponsableFinanzasOrdenCompraAttribute()
    {

        $listaReq = ListaDistribucion::where('modelo', 'OrdenCompra')->first();
        $listaPart = $listaReq->participantes;

        for ($i = 0; $i <= $listaReq->niveles; $i++) {
            $responsableNivel = $listaPart->where('nivel', $i)->where('numero_orden', 1)->first();

            if ($responsableNivel->empleado->disponibilidad->disponibilidad == 1) {

                $responsable = $responsableNivel->empleado;

                return $responsable;
            }
        }

        return false;
    }
}
