<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $fillable = [
        'clave',
        'descripcion',
        'rfc',
        'empresa',
        'cuenta_contable',
        'estado',
        'zona',
        'archivo',
        'direccion',
        'mylogo'
    ];

    public $table = 'sucursales';
}
