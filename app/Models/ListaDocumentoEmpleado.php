<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaDocumentoEmpleado extends Model
{
    use HasFactory;

    protected $table = 'lista_documentos_empleados';

    protected $fillable = [
        'documento',
        'activar_numero',
    ];
}
