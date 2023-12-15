<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class EvidenciasDocumentosEmpleados extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

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

    public static function getAll()
    {
        return Cache::remember('EvidenciasDocumentos:revision_documentos_all', 3600 * 8, function () {
            return self::get();
        });
    }

    public static function getAllWithDocumento()
    {
        return Cache::remember('EvidenciasDocumentos:revision_documentos_all_documentos', 3600 * 8, function () {
            return self::with('documento')->get();
        });
    }

    public function getRutaDocumentoAttribute()
    {
        $empleado = Empleado::select('id', 'name')->find($this->empleado_id);

        return asset('storage/expedientes/'.Str::slug($empleado->name).'/'.$this->documentos);
    }

    public function getRutaAbsolutaDocumentoAttribute()
    {
        $empleado = Empleado::select('id', 'name')->find($this->empleado_id);

        return 'expedientes/'.Str::slug($empleado->name).'/'.$this->documentos;
    }

    public function empleados_documentos()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->alta();
    }
}
