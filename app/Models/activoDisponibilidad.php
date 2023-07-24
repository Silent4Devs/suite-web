<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activoDisponibilidad extends Model
{
    use HasFactory;
    protected $table = 'activo_disponibilidad';

    protected $guarded = [
        'id',
        'disponibilidad',
        'valor',
    ];
}
