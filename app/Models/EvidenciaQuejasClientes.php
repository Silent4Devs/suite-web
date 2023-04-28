<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciaQuejasClientes extends Model
{
    use SoftDeletes;

    protected $table = 'evidencias_quejas_clientes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'quejas_clientes_id' => 'int',
        'evidencia' => 'string',
    ];

    protected $fillable = [
        'quejas_clientes_id',
        'evidencia',
    ];

    public function quejas()
    {
        return $this->belongsTo(QuejasCliente::class, 'quejas_clientes_id', 'id');
    }
}
