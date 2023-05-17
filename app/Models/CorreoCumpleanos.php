<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorreoCumpleanos extends Model
{
    use HasFactory;

    public $table = 'correo_cumpleanos';

    public $timestamps = false;

    protected $fillable = [
        'empleado_id',
        'fecha_envio',
        'enviado',
        'created_at',
        'updated_at',
    ];
}
