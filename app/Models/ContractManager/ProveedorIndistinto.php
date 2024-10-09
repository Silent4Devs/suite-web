<?php

namespace App\Models\ContractManager;

use App\Models\HistorialEdicionesReq;
use App\Models\User;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class ProveedorIndistinto extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'proveedor_indistintos';

    public $fillable = [
        'requisicion_id',
        'proveedor_indistinto_id',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected static function booted()
    {
        static::updating(function ($detalle) {
            $idEmpleado = User::getCurrentUser()->empleado->id;
            foreach ($detalle->getDirty() as $campo => $nuevoValor) {
                $valorAnterior = $detalle->getOriginal($campo);

                HistorialEdicionesReq::create([
                    'requisicion_id' => $detalle->requisicion_id, // asumiendo que la relación es con 'registro_id'
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

    //Redis methods
    public static function getFirst()
    {
        return Cache::remember('Katbol:proveedorIndistinto_first', 3600 * 7, function () {
            return self::first();
        });
    }
}
