<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateAnalisisdeBrechas extends Model
{
    use HasFactory;

    public $table = 'template_analisisde_brechas';

    public $fillable = [
        'nombre_template',
        'norma_id',
        'descripcion',
        'no_secciones',
    ];
}
