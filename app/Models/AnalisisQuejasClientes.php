<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AnalisisQuejasClientes extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $table = 'quejas_clientes_analisis';

    protected $guarded = ['id'];

    public function quejasClientes()
    {
        return $this->belongsTo(QuejasCliente::class, 'quejas_clientes_id', 'id');
    }
}
