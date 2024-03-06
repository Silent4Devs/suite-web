<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Sucursal extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

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

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('Sucursales:Sucursales_all', 3600 * 6, function () {
            return self::get();
        });
    }

    public static function getArchivoFalse()
    {
        return Cache::remember('Sucursales:Sucursales_archivo_false', 3600 * 6, function () {
            return self::select('id', 'clave', 'descripcion', 'rfc', 'empresa', 'cuenta_contable', 'estado', 'zona', 'archivo', 'direccion', 'mylogo')->where('archivo', false)->get();
        });
    }

    public static function getArchivoTrue()
    {
        return Cache::remember('Sucursales:Sucursales_archivo_true', 3600 * 6, function () {
            return self::select('id', 'clave', 'descripcion', 'rfc', 'empresa', 'cuenta_contable', 'estado', 'zona', 'archivo', 'direccion', 'mylogo')->where('archivo', true)->get();
        });
    }

    public static function getPluckId()
    {
        return Cache::remember('Sucursales:Sucursales_pluck_id', 3600 * 6, function () {
            return self::get()->pluck('id');
        });
    }
}
