<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvedorRequisicionCatalogo extends Model
{
    use HasFactory;

    protected $fillable = [
    'requisicion_id',
    'proveedor_id',
    'fecha_inicio',
    'fecha_fin'
    ];

    protected $with = ['provedores'];

    public $table = 'proveedores_requisiciones_catalogos';


    public function provedores()
    {
        return $this->belongsTo(ProveedorOC::class, 'proveedor_id');
    }
}
