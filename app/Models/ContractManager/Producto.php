<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;


class Producto extends Model implements Auditable
{
    use HasFactory, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    public $table = 'productos';

    public $fillable = [
        'id',
        'descripcion',
        'archivo',
        'clave',
    ];
}
