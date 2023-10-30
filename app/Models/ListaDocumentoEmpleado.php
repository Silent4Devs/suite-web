<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListaDocumentoEmpleado extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'lista_documentos_empleados';

    protected $fillable = [
        'documento',
        'activar_numero',
        'tipo',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('listasdocumentosempleados_all', 3600 * 24, function () {
            return self::get();
        });
    }
}
