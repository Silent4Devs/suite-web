<?php

namespace App\Models\ContractManager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $table = 'productos';

    public $fillable = [
        'id',
        'descripcion',
        'archivo',
        'clave',
    ];
}
