<?php

namespace App\Models\Iso27;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClasificacionIso extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'nombre',
    ];
}
