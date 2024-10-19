<?php

namespace App\Models\ContractManager;

use App\Models\HistorialEdicionesReq;
use App\Models\User;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        static::updating(function ($registro) {
            $idEmpleado = User::getCurrentUser()->empleado->id;

            // Obtener la versión activa o la más reciente
            $versionActual = DB::table('versiones_requisicion')
                ->where('requisicion_id', $registro->requisiciones_id)
                ->orderBy('version', 'desc')
                ->first();

            // Verificar si existe una versión reciente
            if (! $versionActual || $versionActual->last_updated_at < now()->subMinutes(1)) {
                // Crear nueva versión
                $nuevaVersion = $versionActual ? $versionActual->version + 1 : 1;

                $versionId = DB::table('versiones_requisicion')->insertGetId([
                    'requisicion_id' => $registro->requisiciones_id,
                    'version' => $nuevaVersion,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'last_updated_at' => now(),
                ]);
            } else {
                // Usar la versión existente
                $versionId = $versionActual->id;
            }

            // Registrar cambios en el historial
            foreach ($registro->getDirty() as $campo => $nuevoValor) {
                $valorAnterior = $registro->getOriginal($campo);

                HistorialEdicionesReq::create([
                    'requisicion_id' => $registro->requisiciones_id,
                    'registro_tipo' => self::class,
                    'id_empleado' => $idEmpleado,
                    'campo' => $campo,
                    'valor_anterior' => $valorAnterior,
                    'valor_nuevo' => $nuevoValor,
                    'version_id' => $versionId,
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
