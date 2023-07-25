<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadCrediticia extends Model
{
    use HasFactory;

    protected $fillable = ['entidad', 'descripcion'];
}
