<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sucursal extends Model
{
    use HasFactory, ClearsResponseCache;

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
        'mylogo',
    ];

    public $table = 'sucursales';
}
