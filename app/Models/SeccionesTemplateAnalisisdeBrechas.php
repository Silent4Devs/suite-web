<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SeccionesTemplateAnalisisdeBrechas extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'secciones_template_analisisde_brechas';

    public $fillable = [
        'template_id',
        'numero_seccion',
        'descripcion',
        'porcentaje_seccion',
    ];

    public function preguntas()
    {
        return $this->hasMany(PreguntasTemplateAnalisisdeBrechas::class, 'seccion_id', 'id');
    }
}
