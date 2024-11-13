<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TemplateAnalisisdeBrechas extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'template_analisisde_brechas';

    public $fillable = [
        'nombre_template',
        'norma_id',
        'descripcion',
        'no_secciones',
        'top',
    ];

    public function secciones()
    {
        return $this->hasMany(SeccionesTemplateAnalisisdeBrechas::class, 'template_id', 'id');
    }

    public function parametros()
    {
        return $this->hasMany(ParametrosTemplateAnalisisdeBrechas::class, 'template_id', 'id');
    }

    public function evaluacionTemplatesAnalisisBrechas($id)
    {
        return self::select('id', 'nombre_template', 'norma_id', 'descripcion', 'no_secciones', 'top')->findOrFail($id);
    }
}
