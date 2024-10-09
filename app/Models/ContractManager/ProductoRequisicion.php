<?php

namespace App\Models\ContractManager;

use App\Models\HistorialEdicionesReq;
use App\Models\User;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProductoRequisicion extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

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


    protected static function booted()
    {
        static::updating(function ($detalle) {
            $idEmpleado = User::getCurrentUser()->empleado->id;
            foreach ($detalle->getDirty() as $campo => $nuevoValor) {
                $valorAnterior = $detalle->getOriginal($campo);
                HistorialEdicionesReq::create([
                    'requisicion_id' => $detalle->requisiciones_id, // asumiendo que la relación es con 'registro_id'
                    'numero_edicion' => 1,
                    'registro_tipo' => self::class,
                    'id_empleado' => $idEmpleado,
                    'campo' => $campo,
                    'valor_anterior' => $valorAnterior,
                    'valor_nuevo' => $nuevoValor,
                ]);
            }
        });
    }

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
