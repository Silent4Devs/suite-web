<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class EvidenciaDocumentoEmpleadoArchivo extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'evidencias_documentos_empleados_archivos';

    protected $fillable = [
        'evidencias_documentos_empleados_id',
        'documento',
        'archivado',
    ];

    protected $appends = ['ruta_documento', 'ruta_absoluta_documento'];

    public function getRutaDocumentoAttribute()
    {
        if ($this->evidencia->empleados_documentos) {
            if ($this->evidencia->empleados_documentos->id) {
                $empleado = Empleado::select('id', 'name')->find($this->evidencia->empleados_documentos->id);

                return asset('storage/expedientes/' . Str::slug($empleado->name) . '/' . $this->documento);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getRutaAbsolutaDocumentoAttribute()
    {
        $empleado = Empleado::select('id', 'name')->find($this->evidencia->empleados_documentos->id);

        return 'expedientes/' . Str::slug($empleado->name) . '/' . $this->documento;
    }

    public function evidencia()
    {
        return $this->belongsTo(EvidenciasDocumentosEmpleados::class, 'evidencias_documentos_empleados_id', 'id');
    }
}
