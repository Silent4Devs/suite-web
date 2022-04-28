<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class AnalisisQuejasClientes extends Model
{
    use HasFactory, SoftDeletes;



    protected $table = 'quejas_clientes_analisis';

    protected $guarded = ['id'];

    public function quejasClientes()
    {
        return $this->belongsTo(QuejasCliente::class, 'quejas_clientes_id', 'id');
    }
}
