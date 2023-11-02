<?php

namespace App\Models\ContractManager;

use App\Models\Empleado;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Comprador extends Model implements Auditable
{
    use HasFactory, ClearsResponseCache;
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
}
