<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorRequisicion extends Model
{
    use HasFactory;

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

}
