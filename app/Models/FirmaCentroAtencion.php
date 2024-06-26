<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmaCentroAtencion extends Model
{
    use HasFactory;

    protected $table = 'firma_centro_atencions';

    protected $fillable = ['modulo_id', 'submodulo_id', 'participantes', 'firma'];
}
