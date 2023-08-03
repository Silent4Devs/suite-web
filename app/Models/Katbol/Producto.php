<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $table = 'productos';

    public $fillable = [
        'descripcion',
        'archivo',
        'clave'
    ];

}
