<?php

namespace App\Models\Visitantes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AvisoPrivacidadVisitante extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'aviso_privacidad',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
