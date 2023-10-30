<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class activoDisponibilidad extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'activo_disponibilidad';

    protected $guarded = [
        'id',
        'disponibilidad',
        'valor',
    ];
}
