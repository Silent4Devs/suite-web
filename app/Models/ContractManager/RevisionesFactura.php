<?php

namespace App\Models\ContractManager;

use App\Models\Empleado;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class RevisionesFactura extends Model implements Auditable
{
    use AuditableTrait;
    use ClearsResponseCache, HasFactory, softDeletes;

    public $table = 'revisiones_facturas';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = [

        'no_revisiones',
        'cumple',
        'observaciones',
        'estatus',
        'id_facturacion',
        'asignado_id',
    ];

    public function asignado()
    {
        return $this->belongsTo(Empleado::class, 'asignado_id', 'id');
    }
}
