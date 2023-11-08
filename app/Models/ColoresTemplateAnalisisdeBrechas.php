<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColoresTemplateAnalisisdeBrechas extends Model
{
    use HasFactory;

    public $table = 'colores_template_analisisde_brechas';

    public $fillable = [
        'template_id',
        'estatus',
        'color',
        'descripcion',
    ];
}
