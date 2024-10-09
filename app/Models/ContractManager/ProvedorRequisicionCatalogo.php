<?php

namespace App\Models\ContractManager;

use App\Models\HistorialEdicionesReq;
use App\Models\User;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProvedorRequisicionCatalogo extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'requisicion_id',
        'proveedor_id',
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

    protected $with = ['provedores'];

    public $table = 'proveedores_requisiciones_catalogos';

    public function provedores()
    {
        return $this->belongsTo(ProveedorOC::class, 'proveedor_id');
    }
}
