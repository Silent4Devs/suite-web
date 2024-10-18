<?php

namespace App\Models\ContractManager;

use App\Models\HistorialEdicionesReq;
use App\Models\User;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        static::updating(function ($registro) {
            $idEmpleado = User::getCurrentUser()->empleado->id;

            // Obtener la versión activa o la más reciente
            $versionActual = DB::table('versiones_requisicion')
                ->where('requisicion_id', $registro->requisicion_id)
                ->orderBy('version', 'desc')
                ->first();

            // Verificar si existe una versión reciente
            if (! $versionActual || $versionActual->last_updated_at < now()->subMinutes(1)) {
                // Crear nueva versión
                $nuevaVersion = $versionActual ? $versionActual->version + 1 : 1;

                $versionId = DB::table('versiones_requisicion')->insertGetId([
                    'requisicion_id' => $registro->requisicion_id,
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
                    'requisicion_id' => $registro->requisicion_id,
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

    protected $with = ['provedores'];

    public $table = 'proveedores_requisiciones_catalogos';

    public function provedores()
    {
        return $this->belongsTo(ProveedorOC::class, 'proveedor_id');
    }
}
