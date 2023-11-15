<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EvidenciasQuejasClientesCerrado extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'evidencia_quejas_clientes_estatus_cerrado';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'quejas_clientes_id' => 'int',
        'cierre' => 'string',
    ];

    protected $fillable = [
        'quejas_clientes_id',
        'cierre',
    ];

    public function quejas()
    {
        return $this->belongsTo(QuejasCliente::class, 'quejas_clientes_id', 'id');
    }
}
