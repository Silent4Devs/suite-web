<?php

namespace App\Models\ContractManager;

use App\Models\FirmasRequisiciones;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Requsicion extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
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
    ];

    public $table = 'requisiciones';

    protected $with = ['productos_requisiciones', 'provedores_requisiciones'];

    //Redis methods
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
                    }
                }
                break;
        }

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

    //relacion-contrato
    public function contrato()
    {
        return $this->hasOne(Contrato::class, 'id', 'contrato_id');
    }

    //relacion-comprador
    public function comprador()
    {
        return $this->hasOne(Comprador::class, 'id', 'comprador_id');
    }

    //relacion-sucursal
    public function sucursal()
    {
        return $this->hasOne(Sucursal::class, 'id', 'sucursal_id');
    }

    //relacion-productos_requisiciones
    public function productos_requisiciones()
    {
        return $this->hasMany(ProductoRequisicion::class, 'requisiciones_id', 'id');
    }

    //relacion-provedores_requisiciones
    public function provedores_requisiciones()
    {
        return $this->hasMany(ProveedorRequisicion::class, 'requisiciones_id', 'id');
    }

    //relacion-provedores_requisiciones
    public function provedores_indistintos_requisiciones()
    {
        return $this->hasMany(ProveedorIndistinto::class, 'requisicion_id', 'id');
    }

    //relacion-provedores_requisiciones
    public function provedores_requisiciones_catalogo()
    {
        return $this->hasMany(ProvedorRequisicionCatalogo::class, 'requisicion_id', 'id');
    }

    public function proveedor()
    {
        return $this->belongsTo(ProveedorOC::class, 'proveedor_id', 'id');
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
}
