<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class CentroCosto extends Model implements Auditable
{
    use HasFactory, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    public $table = 'centro_costos';

    public $fillable = [
        'id',
        'clave',
        'descripcion',
        'estado',
        'archivo',
    ];
}
