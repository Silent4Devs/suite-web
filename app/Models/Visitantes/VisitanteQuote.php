<?php

namespace App\Models\Visitantes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitanteQuote extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'quote',
    ];
}
