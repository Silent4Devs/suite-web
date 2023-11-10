<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProvedorRequisicionCatalogo extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'requisicion_id',
        'proveedor_id',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $with = ['provedores'];

    public $table = 'proveedores_requisiciones_catalogos';

    public function provedores()
    {
        return $this->belongsTo(ProveedorOC::class, 'proveedor_id');
    }
}
