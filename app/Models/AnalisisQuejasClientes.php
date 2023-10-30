<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnalisisQuejasClientes extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'quejas_clientes_analisis';

    protected $guarded = ['id'];

    public function quejasClientes()
    {
        return $this->belongsTo(QuejasCliente::class, 'quejas_clientes_id', 'id');
    }
}
