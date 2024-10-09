<?php

namespace App\Models\ContractManager;

use App\Models\HistorialEdicionesReq;
use App\Models\User;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProveedorRequisicion extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'proveedor',
        'detalles',
        'tipo',
        'comentarios',
        'contacto',
        'contacto_correo',
        'url',
        'cel',
        'fecha_inicio',
        'fecha_fin',
        'cotizacion',
        'requisiciones_id',
    ];

    public $table = 'proveedor_requisicions';

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
}
