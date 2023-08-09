<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorOC extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'nombre',
        'razon_social',
        'rfc',
        'contacto',
        'estado',
        'facturacion',
        'direccion',
        'envio',
        'credito',
        'fecha_inicio',
        'fecha_fin'
        ];

    public $table = 'proveedor_o_c_s';
}
