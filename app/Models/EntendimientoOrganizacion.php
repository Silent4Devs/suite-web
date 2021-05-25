<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntendimientoOrganizacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "entendimiento_organizacions";
    protected $fillable = [
        'fortalezas', 'oportunidades', 'debilidades', 'amenazas'
    ];
}
