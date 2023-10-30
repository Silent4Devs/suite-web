<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProvedorRequisicionCatalogo extends Model
{
    use HasFactory, ClearsResponseCache;

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
