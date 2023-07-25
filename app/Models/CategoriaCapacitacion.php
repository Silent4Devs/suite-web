<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaCapacitacion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'categoria_capacitacions';

    protected $fillable = ['nombre'];

    public function recursos()
    {
        return $this->hasMany(Recurso::class);
    }
}
