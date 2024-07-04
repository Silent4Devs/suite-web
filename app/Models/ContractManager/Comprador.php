<?php

namespace App\Models\ContractManager;

use App\Models\Empleado;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Comprador extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'compradores';

    public $fillable = [
        'id',
        'clave',
        'nombre',
        'estado',
        'id_user',
        'archivo',
    ];

    public function user()
    {
        return $this->belongsTo(Empleado::class, 'id_user');
    }

    public static function getAll()
    {
        return Cache::remember('Comprador:Comprador_all', 3600 * 6, function () {
            return self::get();
        });
    }

    public static function getAllWithUser()
    {
        return Cache::remember('Comprador:Comprador_user_all', 3600 * 6, function () {
            return self::with('user')->get();
        });
    }
}
