<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ListaDocumentoEmpleado extends Model
{
    use HasFactory;

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
