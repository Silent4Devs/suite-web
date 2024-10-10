<?php

namespace App\Models\ContractManager;

use App\Models\HistorialEdicionesReq;
use App\Models\User;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        static::updating(function ($registro) {
            $idEmpleado = User::getCurrentUser()->empleado->id;

            // Obtener la versión activa o la más reciente
            $versionActual = DB::table('versiones_requisicion')
                ->where('requisicion_id', $registro->requisiciones_id)
                ->orderBy('version', 'desc')
                ->first();

            // Verificar si existe una versión reciente
            if (!$versionActual || $versionActual->last_updated_at < now()->subMinutes(1)) {
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
}
