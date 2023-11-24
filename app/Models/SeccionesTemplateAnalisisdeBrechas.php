<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionesTemplateAnalisisdeBrechas extends Model
{
    use HasFactory;

    public $table = 'secciones_template_analisisde_brechas';

    public $fillable = [
        'template_id',
        'numero_seccion',
        'descripcion',
        'porcentaje_seccion',
    ];
}
