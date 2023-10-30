<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requsicion extends Model implements Auditable
{
    use HasFactory, ClearsResponseCache;
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
        'proveedor_catalogo_id',
        'ids_proveedores',
        'proveedoroc_id',
        'email',
    ];

    protected $appends = [
        'folio',
    ];

    public $table = 'requisiciones';

    protected $with = ['productos_requisiciones', 'provedores_requisiciones'];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('organizacion_all', 3600 * 24, function () {
            return self::get();
        });
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

        $codigo = $tipo . sprintf('%02d-%04d', $parte1, $parte2);

        return $codigo;
    }
}
