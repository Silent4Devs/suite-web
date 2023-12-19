<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametrosTemplateAnalisisdeBrechas extends Model
{
    use HasFactory;

    public $table = 'parametros_template_analisisde_brechas';

    public $fillable = [
        'template_id',
        'estatus',
        'color',
        'valor',
        'descripcion',
    ];
}
