<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class CategoriaIncidente extends Model
{
    use HasFactory;
   
    protected $table = 'categorias_incidentes';

    protected $guarded = [
        'id',
    ];
}
