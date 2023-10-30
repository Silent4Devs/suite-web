<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class ProveedorIndistinto extends Model implements Auditable
{
    use HasFactory, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    public $table = 'proveedor_indistintos';

    public $fillable = [
        'requisicion_id',
        'proveedor_indistinto_id',
        'fecha_inicio',
        'fecha_fin',
    ];
}
