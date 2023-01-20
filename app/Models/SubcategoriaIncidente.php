<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class SubcategoriaIncidente extends Model
{
    use HasFactory;
   
    protected $table = 'subcategorias_incidentes';

    protected $guarded = [
        'id',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaIncidente::class, 'categoria_id', 'id');
    }
}
