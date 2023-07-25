<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activoIntegridad extends Model
{
    use HasFactory;

    protected $table = 'activo_integridad';

    protected $guarded = [
        'id',
        'integridad',
        'valor',
    ];
}
