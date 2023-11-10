<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoRequisicion extends Model
{
    use ClearsResponseCache, HasFactory;

    protected $fillable = [
        'espesificaciones',
        'cantidad',
        'producto_id',
        'requisiciones_id',
        'contrato_id',
        'no_personas',
        'porcentaje_involucramiento',
        'centro_costo_id',
        'sub_total',
        'iva',
        'iva_retenido',
        'descuento',
        'otro_impuesto',
        'isr_retenido',
        'total',
    ];

    public $table = 'productos_requisicion';

    protected $with = ['producto', 'contrato', 'centro_costo'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id', 'id');
    }

    public function centro_costo()
    {
        return $this->belongsTo(CentroCosto::class, 'centro_costo_id', 'id');
    }
}
