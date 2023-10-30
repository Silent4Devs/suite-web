<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciasDocumentosEmpleados extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'evidencias_documentos_empleados';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'empleado_id' => 'int',
        'documentos' => 'string',

    ];

    protected $fillable = [
        'empleado_id',
        'documentos',
        'nombre',
        'numero',
        'archivado',
        'lista_documentos_empleados_id',
    ];

    protected $appends = ['ruta_documento', 'ruta_absoluta_documento'];

    public function getRutaDocumentoAttribute()
    {
        $empleado = Empleado::select('id', 'name')->find($this->empleado_id);

        return asset('storage/expedientes/' . Str::slug($empleado->name) . '/' . $this->documentos);
    }

    public function getRutaAbsolutaDocumentoAttribute()
    {
        $empleado = Empleado::select('id', 'name')->find($this->empleado_id);

        return 'expedientes/' . Str::slug($empleado->name) . '/' . $this->documentos;
    }

    public function empleados_documentos()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->alta();
    }
}
