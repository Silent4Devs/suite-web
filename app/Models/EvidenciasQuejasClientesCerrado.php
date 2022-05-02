<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciasQuejasClientesCerrado extends Model
{
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
